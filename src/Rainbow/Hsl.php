<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow;

use Rainbow\Translator\HslToRgbTranslator;
use Rainbow\Unit\Alpha;
use Rainbow\Unit\Angle;
use Rainbow\Unit\Percent;

final class Hsl implements ColorInterface
{
    private $hue;
    private $saturation;
    private $lightness;

    public function __construct($hue = 0, $saturation = 0, $lightness = 0)
    {
        $this->hue = new Angle($hue);
        $this->saturation = new Percent($saturation);
        $this->lightness = new Percent($lightness);
    }

    public function getHue()
    {
        return $this->hue;
    }

    public function getSaturation()
    {
        return $this->saturation;
    }

    public function getLightness()
    {
        return $this->lightness;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return sprintf("hsl(%s,%s,%s)",
            $this->getHue(),
            $this->getSaturation(),
            $this->getLightness()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getAlpha()
    {
        return new Alpha(1);
    }

    /**
     * {@inheritDoc}
     */
    public function toHsl()
    {
        return new self(
            $this->getHue()->getValue(),
            $this->getSaturation()->getValue(),
            $this->getLightness()->getValue()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toRgb()
    {
        $translator = new HslToRgbTranslator($this);

        return $translator->translate();
    }

    /**
     * {@inheritDoc}
     * @return Hsl
     */
    public function saturate($saturation)
    {
        return new self(
            $this->getHue()->getValue(),
            min($this->getSaturation()->getValue() + $saturation, 100),
            $this->getLightness()->getValue()
        );
    }

    /**
     * {@inheritDoc}
     * @return Hsl
     */
    public function desaturate($saturation)
    {
        return new self(
            $this->getHue()->getValue(),
            max($this->getSaturation()->getValue() - $saturation, 0),
            $this->getLightness()->getValue()
        );
    }
}
