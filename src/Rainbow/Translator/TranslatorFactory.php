<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Translator;

use Doctrine\Instantiator\Exception\UnexpectedValueException;
use Rainbow\ColorInterface;

final class TranslatorFactory
{
    /**
     * @param ColorInterface $color
     * @param $resultingColorName
     * @return TranslatorInterface
     */
    public static function create(ColorInterface $color, $resultingColorName)
    {
        $result = strtolower(trim($resultingColorName));
        if ($result === $color->getName()) {

            return new NullTranslator($color);
        }
        $class = sprintf(
            'Rainbow\Translator\%sTo%sTranslator',
            ucfirst($color->getName()),
            ucfirst($result)
        );
        if (!class_exists($class)) {
            throw new UnexpectedValueException(
                sprintf(
                    "Translator not found: from %s to %s",
                    $color->getName(),
                    $resultingColorName
                )
            );
        }

        return new $class($color);
    }
}
