<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Translator;

use Rainbow\Rgb;

final class TranslatorFactory
{
    public static function create(Rgb $color, $resultingColorName)
    {
        return new RgbToHslTranslator($color);
    }
}
