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

final class HslConverter
{
    public static function toRgb(Hsl $color)
    {
        return RgbConverter::fromHsl($color);
    }

    public static function fromRgb(Rgb $color)
    {
        return RgbConverter::toHsl($color);
    }

    public static function toHsl(Hsl $color)
    {
        return $color->copy();
    }

    public static function fromHsl(Hsl $color)
    {
        return $color->copy();
    }
}
