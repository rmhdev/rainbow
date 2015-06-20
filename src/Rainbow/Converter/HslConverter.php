<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Converter;

use Rainbow\Hsl;
use Rainbow\Rgb;
use Rainbow\Unit\RgbComponent;

final class HslConverter
{
    /**
     * @var Hsl
     */
    private $color;

    public function __construct(Hsl $color)
    {
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->color->copy();
    }

    public function toRgb()
    {
        list($red, $green, $blue) = $this->calculateRgbValues();

        return new Rgb($red, $green, $blue);
    }

    public function toHsl()
    {
        return $this->color->copy();
    }

    private function calculateRgbValues()
    {
        $hue = $this->color->getHue()->getValue() / 360;
        $saturation = $this->color->getSaturation()->getValue() / 100;
        $lightness = $this->color->getLightness()->getValue() / 100;

        $m2 = (0.5 >= $lightness) ?
            $lightness * ($saturation + 1) :
            $lightness + $saturation - ($lightness * $saturation);
        $m1 = $lightness * 2 - $m2;

        $red = $this->hueToRgb($m1, $m2, $hue + 1/3);
        $green = $this->hueToRgb($m1, $m2, $hue);
        $blue = $this->hueToRgb($m1, $m2, $hue - 1/3);

        return array(
            $red * RgbComponent::MAX_VALUE,
            $green * RgbComponent::MAX_VALUE,
            $blue * RgbComponent::MAX_VALUE
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

    public static function createFromRgb(Rgb $color)
    {
        $converter = new RgbConverter($color);

        return new self($converter->toHsl());
    }

    public static function createFromHsl(Hsl $color)
    {
        return new self($color);
    }
}
