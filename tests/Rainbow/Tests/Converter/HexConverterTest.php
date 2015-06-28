<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Converter;

use Rainbow\Converter\HexConverter;
use Rainbow\Hex;
use Rainbow\Hsl;
use Rainbow\Rgb;

class HexConverterTest extends AbstractConverterTest
{
    public function testGetColorShouldReturnHex()
    {
        $color = new Hex(100, 150, 200);
        $converter = new HexConverter($color);

        $this->assertEquals($color, $converter->getColor());
    }
    /**
     * @dataProvider rgbHexEquivalences
     * @param Rgb $expected
     * @param Hex $color
     */
    public function testToRgbShouldReturnRgb(Rgb $expected, Hex $color)
    {
        $converter = new HexConverter($color);

        $this->assertEquals($expected, $converter->toRgb());
    }

    public function rgbHexEquivalences()
    {
        return $this->getEquivalences("rgb", "hex");
    }

    /**
     * @dataProvider hslHexEquivalences
     * @param Hsl $expected
     * @param Hex $color
     */
    public function testToHsl(Hsl $expected, Hex $color)
    {
        $converter = new HexConverter($color);

        $this->assertEquals($expected, $converter->toHsl());
    }

    public function hslHexEquivalences()
    {
        return $this->getEquivalences("hsl", "hex");
    }

    /**
     * @dataProvider hexRgbEquivalences
     * @param Hex $expected
     * @param Rgb $color
     */
    public function testCreateFromRgbShouldReturnHexConverter(Hex $expected, Rgb $color)
    {
        $converter = new HexConverter($expected);

        $this->assertEquals($converter, HexConverter::create($color));
    }

    public function hexRgbEquivalences()
    {
        return $this->getEquivalences("hex", "rgb");
    }

    /**
     * @dataProvider hexHslEquivalences
     * @param Hex $expected
     * @param Hsl $color
     */
    public function testCreateFromHslShouldReturnHexConverter(Hex $expected, Hsl $color)
    {
        $converter = new HexConverter($expected);

        $this->assertEquals($converter, HexConverter::create($color));
    }

    public function hexHslEquivalences()
    {
        return $this->getEquivalences("hex", "hsl");
    }

    public function testCreateFromHexShouldReturnHexConverter()
    {
        $color = new Hex("#ff0033");
        $converter = new HexConverter($color);

        $this->assertEquals($converter, HexConverter::create($color));
    }
}
