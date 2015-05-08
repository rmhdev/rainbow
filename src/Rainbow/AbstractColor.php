<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow;

use Rainbow\Calculation\Luminance;
use Rainbow\Calculation\Operation\Saturation;
use Rainbow\Translator\Translator;

abstract class AbstractColor implements ColorInterface
{
    /**
     * @var Hsl
     */
    private $localHsl;

    /**
     * {@inheritDoc}
     */
    public function copy()
    {
        return clone $this;
    }

    /**
     * {@inheritDoc}
     */
    public function saturate($percentage)
    {
        return $this->updateSaturation($percentage);
    }

    private function updateSaturation($percentage)
    {
        $saturation = new Saturation($this->getLocalHsl(), $percentage);

        return $this->toCurrent($saturation->result());
    }

    /**
     * {@inheritDoc}
     */
    public function desaturate($percentage)
    {
        return $this->updateSaturation(-$percentage);
    }

    /**
     * Converts back to the current color space
     * @param Hsl $color
     * @return ColorInterface
     */
    abstract protected function toCurrent(Hsl $color);

    /**
     * @return number
     */
    private function localHueValue()
    {
        return $this->getLocalHsl()->getHue()->getValue();
    }

    /**
     * @param int $percentage
     * @return number
     */
    private function localSaturationValue($percentage = 0)
    {
        $value = $this->getLocalHsl()->getSaturation()->getValue();

        return $this->formatPercentage($value, $percentage);
    }

    private function formatPercentage($value = 0, $percentage = 0)
    {
        if (!$percentage) {
            return $value;
        }
        if ($percentage < 0) {
            return max($value + $percentage, 0);
        }

        return min($value + $percentage, 100);
    }

    /**
     * @param int $percentage
     * @return number
     */
    private function localLightnessValue($percentage = 0)
    {
        $value = $this->getLocalHsl()->getLightness()->getValue();

        return $this->formatPercentage($value, $percentage);
    }

    /**
     * @return Hsl
     */
    private function getLocalHsl()
    {
        if (is_null($this->localHsl)) {
            $this->localHsl = $this->translate()->toHsl();
        }

        return $this->localHsl;
    }



    /**
     * {@inheritDoc}
     */
    public function lighten($percentage)
    {
        return $this->toCurrent(
            new Hsl(
                $this->localHueValue(),
                $this->localSaturationValue(),
                $this->localLightnessValue($percentage)
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function darken($percentage)
    {
        return $this->toCurrent(
            new Hsl(
                $this->localHueValue(),
                $this->localSaturationValue(),
                $this->localLightnessValue(-$percentage)
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function translate()
    {
        return new Translator($this);
    }

    /**
     * {@inheritDoc}
     */
    public function luminance()
    {
        $luminance = new Luminance($this->translate()->toRgb());

        return $luminance->getValue();
    }
}
