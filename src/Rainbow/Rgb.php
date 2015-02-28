<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow;

use Rainbow\Unit\Alpha;
use Rainbow\Unit\Component;

class Rgb implements ColorInterface
{
    private $red;
    private $green;
    private $blue;

    public function __construct($red = 0, $green = 0, $blue = 0)
    {
        $this->red = new Component($red);
        $this->green = new Component($green);
        $this->blue = new Component($blue);
    }

    /**
     * @return Component
     */
    public function getRed()
    {
        return $this->red;
    }

    /**
     * @return Component
     */
    public function getGreen()
    {
        return $this->green;
    }

    /**
     * @return Component
     */
    public function getBlue()
    {
        return $this->blue;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return sprintf("rgb(%s,%s,%s)",
            $this->getRed(),
            $this->getGreen(),
            $this->getBlue()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getAlpha()
    {
        return new Alpha(1);
    }

    public function toRgb()
    {
        return new self(
            $this->getRed()->getValue(),
            $this->getGreen()->getValue(),
            $this->getBlue()->getValue()
        );
    }

    public function toHsl()
    {
        list($hue, $saturation, $lightness) = $this->calculateHslValues();

        return new Hsl($hue, $saturation, $lightness);
    }

    /**
     * @url https://hg.python.org/cpython/file/2.7/Lib/colorsys.py
     * @return array
     */
    private function calculateHslValues()
    {
        $red = $this->getRed()->getValue() / Component::MAX_INT;
        $green = $this->getGreen()->getValue() / Component::MAX_INT;
        $blue = $this->getBlue()->getValue() / Component::MAX_INT;

        $max = max($red, $green, $blue);
        $min = min($red, $green, $blue);
        $delta = $max - $min;
        $lightness = ($max + $min) / 2;

        if (0 == $delta) {
            return array(0, 0, $lightness * 100);
        }
        $saturation = (0.5 >= $lightness) ?
            ($delta / ($max + $min)) :
            ($delta / (2.0 - $max - $min));
        switch ($max) {
            case $red:      $hue = (($green - $blue) / $delta); break;
            case $green:    $hue = (($blue - $red) / $delta) + 2; break;
            default:        $hue = (($red - $green) / $delta) + 4; break;
        }
        $hue = $hue * (360 / 6);

        return array($hue, $saturation * 100, $lightness * 100);
    }

    public function getHue()
    {
        return $this->toHsl()->getHue();
    }

    public function getSaturation()
    {
        return $this->toHsl()->getSaturation();
    }

    public function getLightness()
    {
        return $this->toHsl()->getLightness();
    }

    /**
     * {@inheritDoc}
     */
    public function saturate($saturation)
    {
        return $this->toHsl()->saturate($saturation)->toRgb();
    }
}
