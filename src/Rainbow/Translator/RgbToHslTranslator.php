<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Translator;

use Rainbow\Hsl;
use Rainbow\Rgb;
use Rainbow\Unit\Component;

final class RgbToHslTranslator implements TranslatorInterface
{
    private $color;
    private $hue;
    private $saturation;
    private $lightness;

    public function __construct(Rgb $color)
    {
        $this->color = $color;
    }

    /**
     * {@inheritDoc}
     * @return Hsl
     */
    public function translate()
    {
        if (!$this->isTranslated()) {
            $this->updateHslValues();
        }

        return new Hsl($this->hue, $this->saturation, $this->lightness);
    }

    private function isTranslated()
    {
        return !is_null($this->hue);
    }


    private function updateHslValues()
    {
        list($hue, $saturation, $lightness) = $this->calculateValues();

        $this->hue = $hue;
        $this->saturation = $saturation;
        $this->lightness = $lightness;
    }

    /**
     * @url https://hg.python.org/cpython/file/2.7/Lib/colorsys.py
     * @return array
     */
    private function calculateValues()
    {
        list($red, $green, $blue) = $this->getComponents();

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

    private function getComponents()
    {
        $red = $this->color->getRed()->getValue() / Component::MAX_VALUE;
        $green = $this->color->getGreen()->getValue() / Component::MAX_VALUE;
        $blue = $this->color->getBlue()->getValue() / Component::MAX_VALUE;

        return array($red, $green, $blue);
    }
}