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
     * @dataProvider toRgbDataProvider
     * @param Rgb $expected
     * @param Hex $color
     */
    public function testToRgbShouldReturnRgb(Rgb $expected, Hex $color)
    {
        $converter = new HexConverter($color);

        $this->assertEquals($expected, $converter->toRgb());
    }

    public function toRgbDataProvider()
    {
        return array_map(
            function ($item) {
                return array_reverse($item);
            },
            $this->rgbEquivalences()
        );
    }

    public function rgbEquivalences()
    {
        return array_map(
            function ($item) {
                return array($item["hex"], $item["rgb"]);
            },
            $this->equivalences()
        );
    }

    private function equivalences()
    {
        return array(
            array(
                "hex"   => new Hex("000000"),
                "rgb"   => new Rgb(0, 0, 0),
                "hsl"   => new Hsl(0, 0, 0),
            ),
            array(
                "hex"   => new Hex("#ff0000"),
                "rgb"   => new Rgb(255, 0, 0),
                "hsl"   => new Hsl(0, 100, 50),
            ),
            array(
                "hex"   => new Hex("#00ff00"),
                "rgb"   => new Rgb(0, 255, 0),
                "hsl"   => new Hsl(120, 100, 50),
            ),
            array(
                "hex"   => new Hex("#0000ff"),
                "rgb"   => new Rgb(0, 0, 255),
                "hsl"   => new Hsl(240, 100, 50),
            ),
            array(
                "hex"   => new Hex("#ffffff"),
                "rgb"   => new Rgb(255, 255, 255),
                "hsl"   => new Hsl(0, 0, 100),
            ),
        );
    }

    /**
     * @dataProvider toHslProvider
     * @param Hsl $expected
     * @param Hex $color
     */
    public function testToHsl(Hsl $expected, Hex $color)
    {
        $converter = new HexConverter($color);

        $this->assertEquals($expected, $converter->toHsl());
    }

    public function toHslProvider()
    {
        return array_map(
            function ($item) {
                return array_reverse($item);
            },
            $this->hslEquivalences()
        );
    }

    public function hslEquivalences()
    {
        return array_map(
            function ($item) {
                return array($item["hex"], $item["hsl"]);
            },
            $this->equivalences()
        );
    }


    /**
     * @dataProvider rgbEquivalences
     * @param Hex $expected
     * @param Rgb $color
     */
    public function testCreateFromRgbShouldReturnHexConverter(Hex $expected, Rgb $color)
    {
        $converter = new HexConverter($expected);

        $this->assertEquals($converter, HexConverter::createFromRgb($color));
    }

    /**
     * @dataProvider hslEquivalences
     * @param Hex $expected
     * @param Hsl $color
     */
    public function testCreateFromHslShouldReturnHexConverter(Hex $expected, Hsl $color)
    {
        $converter = new HexConverter($expected);

        $this->assertEquals($converter, HexConverter::createFromHsl($color));
    }
}
