<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Converter;

use Rainbow\Rgb;

final class RgbConverter
{
    public static function toRgb(Rgb $color)
    {
        return $color->copy();
    }
}
