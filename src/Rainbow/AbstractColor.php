<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow;

use Rainbow\Translator\Translator;
use Rainbow\Unit\Component;
use Rainbow\Unit\Percent;

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
        return $this->toCurrent(
            new Hsl(
                $this->localHueValue(),
                $this->localSaturationValue($percentage),
                $this->localLightnessValue()
            )
        );
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
    public function desaturate($percentage)
    {
        return $this->toCurrent(
            new Hsl(
                $this->localHueValue(),
                $this->localSaturationValue(-$percentage),
                $this->localLightnessValue()
            )
        );
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
        $rgb = $this->getLocalHsl()->translate()->toRgb();
        $red = $rgb->getRed()->getValue() / Component::MAX_VALUE;
        $green = $rgb->getGreen()->getValue() / Component::MAX_VALUE;
        $blue = $rgb->getBlue()->getValue() / Component::MAX_VALUE;

        $red    = ($red <= 0.03928)     ? $red / 12.92 : (($red + 0.055) / 1.055) ** 2.4;
        $green  = ($green <= 0.03928)   ? $green / 12.92 : (($green + 0.055) / 1.055) ** 2.4;
        $blue   = ($blue <= 0.03928)    ? $blue / 12.92 : (($blue + 0.055) / 1.055) ** 2.4;

        $value = 0.2126 * $red + 0.7152 * $green + 0.0722 * $blue;

        return new Percent($value * 100);
    }
}
