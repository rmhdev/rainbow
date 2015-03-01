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

final class HslToRgbTranslator implements TranslatorInterface
{
    private $color;
    private $red;
    private $green;
    private $blue;

    public function __construct(Hsl $color)
    {
        $this->color = $color;
    }

    /**
     * {@inheritDoc}
     * @return Rgb
     */
    public function translate()
    {
        if (!$this->isTranslated()) {
            $this->updateValues();
        }

        return new Rgb($this->red, $this->green, $this->blue);
    }

    private function isTranslated()
    {
        return (!is_null($this->red));
    }

    private function updateValues()
    {
        list($red, $green, $blue) = $this->calculateRgbValues();

        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
    }

    /**
     * @url http://www.w3.org/TR/css3-color/#hsl-color
     */
    private function calculateRgbValues()
    {
        list($hue, $saturation, $lightness) = $this->getComponents();

        $m2 = (0.5 >= $lightness) ?
            $lightness * ($saturation + 1) :
            $lightness + $saturation - ($lightness * $saturation);
        $m1 = $lightness * 2 - $m2;

        $red = $this->hueToRgb($m1, $m2, $hue + 1/3);
        $green = $this->hueToRgb($m1, $m2, $hue);
        $blue = $this->hueToRgb($m1, $m2, $hue - 1/3);

        return array(
            $red * Component::MAX_VALUE,
            $green * Component::MAX_VALUE,
            $blue * Component::MAX_VALUE
        );
    }

    private function getComponents()
    {
        return array(
            $this->color->getHue()->getValue() / 360,
            $this->color->getSaturation()->getValue() / 100,
            $this->color->getLightness()->getValue() / 100
        );
    }

    private function hueToRgb($m1, $m2, $hue)
    {
        if (0 > $hue) {
            $hue += 1;
        } elseif (1 < $hue) {
            $hue -= 1;
        }
        if (1 > ($hue * 6)) {
            return $m1 + ($m2 - $m1) * $hue * 6;
        }
        if (1 > ($hue * 2)) {
            return $m2;
        }
        if (2 > $hue * 3) {
            return $m1 + ($m2 - $m1) * (2/3 - $hue) * 6;
        }

        return $m1;
    }
}
