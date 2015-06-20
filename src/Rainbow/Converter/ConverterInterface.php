<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Converter;

use Rainbow\ColorInterface;
use Rainbow\Rgb;
use Rainbow\Hsl;

interface ConverterInterface
{
    /**
     * Returns the color
     * @return ColorInterface
     */
    public function getColor();

    /**
     * Returns the translated color
     * @return Rgb
     */
    public function toRgb();

    /**
     * Returns the translated color
     * @return Hsl
     */
    public function toHsl();

    /**
     * Create a Converter based on the color
     * @param ColorInterface $color
     * @return ConverterInterface
     */
    public static function create(ColorInterface $color);
}
