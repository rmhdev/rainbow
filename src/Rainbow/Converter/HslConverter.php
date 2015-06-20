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
    public static function toRgb(Hsl $color)
    {
        list($red, $green, $blue) = self::calculateRgbValues($color);

        return new Rgb($red, $green, $blue);
    }

    public static function fromRgb(Rgb $color)
    {
        $converter = new RgbConverter($color);

        return $converter->toHsl();
    }

    public static function toHsl(Hsl $color)
    {
        return $color->copy();
    }

    public static function fromHsl(Hsl $color)
    {
        return $color->copy();
    }

    private static function calculateRgbValues(Hsl $color)
    {
        $hue = $color->getHue()->getValue() / 360;
        $saturation = $color->getSaturation()->getValue() / 100;
        $lightness = $color->getLightness()->getValue() / 100;

        $m2 = (0.5 >= $lightness) ?
            $lightness * ($saturation + 1) :
            $lightness + $saturation - ($lightness * $saturation);
        $m1 = $lightness * 2 - $m2;

        $red = self::hueToRgb($m1, $m2, $hue + 1/3);
        $green = self::hueToRgb($m1, $m2, $hue);
        $blue = self::hueToRgb($m1, $m2, $hue - 1/3);

        return array(
            $red * RgbComponent::MAX_VALUE,
            $green * RgbComponent::MAX_VALUE,
            $blue * RgbComponent::MAX_VALUE
        );
    }

    private static function hueToRgb($m1, $m2, $hue)
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
