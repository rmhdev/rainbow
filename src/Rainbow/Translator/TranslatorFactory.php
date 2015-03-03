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
            throw new \UnexpectedValueException(
                sprintf(
                    "It is not possible to translate a color to its same type (%s to %s)",
                    $color->getName(),
                    $resultingColorName
                )
            );
        }
        if ("hsl" === $resultingColorName) {

            return new RgbToHslTranslator($color);
        }

        return new HslToRgbTranslator($color);
    }
}
