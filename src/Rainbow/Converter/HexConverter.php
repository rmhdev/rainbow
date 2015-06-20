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
use Rainbow\Unit\HexComponent;

final class HexConverter
{
    private $color;

    public function __construct(Hex $color)
    {
        $this->color = $color;
    }

    public function toRgb()
    {
        return new Rgb(
            hexdec($this->color->getRed()->getValue()),
            hexdec($this->color->getGreen()->getValue()),
            hexdec($this->color->getBlue()->getValue())
        );
    }

    public static function fromRgb(Rgb $color)
    {
        $redHEx     = new HexComponent(dechex((string)$color->getRed()));
        $greenHEx   = new HexComponent(dechex((string)$color->getGreen()));
        $blueHEx    = new HexComponent(dechex((string)$color->getBlue()));

        $hexValue = sprintf(
            "#%s%s%s",
            $redHEx->getValue(),
            $greenHEx->getValue(),
            $blueHEx->getValue()
        );

        return new Hex($hexValue);
    }

    public function toHsl()
    {
        $converter = new RgbConverter($this->toRgb());

        return $converter->toHsl();
    }
}
