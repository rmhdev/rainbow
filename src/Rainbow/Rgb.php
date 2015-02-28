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

class Rgb
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

    public function __toString()
    {
        return sprintf("rgb(%s,%s,%s)",
            $this->getRed(),
            $this->getGreen(),
            $this->getBlue()
        );
    }

    public function getAlpha()
    {
        return new Alpha(1);
    }

    public function toHsl()
    {
        list($hue, $saturation, $lightness) = $this->calculateHsl();

//        http://stackoverflow.com/questions/2353211/hsl-to-rgb-color-conversion
//        if ($max == $min) {
//            $hue = $saturation = 0;
//        } else {
//            $delta = $max - $min;
//            $saturation = ($lightness > 0.5) ? ($delta / (2 - $max - $min)) : ($delta / ($max + $min));
//            switch ($max) {
//                case $red :     $hue = ($green - $blue) / $delta + ($green < $blue ? 6 : 0); break;
//                case $green:    $hue = ($blue - $red) / $delta - 2; break;
//                case $blue:     $hue = ($red - $green) / $delta + 4; break;
//            }
//            $hue /= 6;
//        }

        return new Hsl($hue, $saturation*100, $lightness*100);
    }

    /**
     * @url https://hg.python.org/cpython/file/2.7/Lib/colorsys.py#l67
     * @return array
     */
    private function calculateHsl()
    {
        $red = $this->getRed()->getValue() / Component::MAX_INT;
        $green = $this->getGreen()->getValue() / Component::MAX_INT;
        $blue = $this->getBlue()->getValue() / Component::MAX_INT;

        $max = max($red, $green, $blue);
        $min = min($red, $green, $blue);

        $lightness = ($max + $min) / 2;
        if ($min == $max) {
            return array(0, 0, $lightness);
        }
        $saturation = (0.5 >= $lightness) ?
            (($max - $min) / ($max + $min)) :
            (($max - $min) / (2.0 - $max - $min));

        $rc = ($max - $red)     / ($max - $min);
        $gc = ($max - $green)   / ($max - $min);
        $bc = ($max - $blue)    / ($max - $min);
        if ($max == $red) {
            $hue = $bc - $rc;
        } elseif ($max == $green) {
            $hue = 2.0 + $rc - $bc;
        } else {
            $hue = 4.0 + $gc - $rc;
        }
        $hue = $hue * (360 / 6);

        return array($hue, $saturation, $lightness);
    }
}
