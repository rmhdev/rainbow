<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Translator;

use Rainbow\ColorInterface;

final class TranslatorFactory
{
    public static function create(ColorInterface $color, $resultingColorName)
    {
        if ($resultingColorName === $color->getName()) {

            return new NullTranslator($color);
        }
        if ("hsl" === $resultingColorName) {

            return new RgbToHslTranslator($color);
        }

        return new HslToRgbTranslator($color);
    }
}
