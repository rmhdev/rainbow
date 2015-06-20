<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Converter;

use Rainbow\Hex;
use Rainbow\Rgb;

final class HexConverter
{
    /**
     * @var Hex
     */
    private $color;

    public function __construct(Hex $color)
    {
        $this->color = $color;
    }

    public function getColor()
    {
        return clone $this->color;
    }

    public function toRgb()
    {
        return new Rgb(
            hexdec($this->color->getRed()->getValue()),
            hexdec($this->color->getGreen()->getValue()),
            hexdec($this->color->getBlue()->getValue())
        );
    }

    public function toHsl()
    {
        $converter = new RgbConverter($this->toRgb());

        return $converter->toHsl();
    }
}
