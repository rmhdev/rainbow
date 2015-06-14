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
    /**
     * @dataProvider toRgbDataProvider
     * @param Rgb $expected
     * @param Hex $color
     */
    public function testToRgbShouldReturnRgb(Rgb $expected, Hex $color)
    {
        $this->assertEquals($expected, HexConverter::toRgb($color));
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

    private function rgbEquivalences()
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
     * @dataProvider fromRgbProvider
     * @param Hex $expected
     * @param Rgb $color
     */
    public function testFromRgb(Hex $expected, Rgb $color)
    {
        $this->assertEquals($expected, HexConverter::fromRgb($color));
    }

    public function fromRgbProvider()
    {
        return $this->rgbEquivalences();
    }

    /**
     * @dataProvider toHslProvider
     * @param Hsl $expected
     * @param Hex $color
     */
    public function testToHsl(Hsl $expected, Hex $color)
    {
        $this->assertEquals($expected, HexConverter::toHsl($color));
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

    /**
     * @dataProvider fromHslProvider
     * @param Hex $expected
     * @param Hsl $color
     */
    public function testFromHsl(Hex $expected, Hsl $color)
    {
        $this->assertEquals($expected, HexConverter::fromHsl($color));
    }

    public function fromHslProvider()
    {
        return $this->hslEquivalences();
    }

    private function hslEquivalences()
    {
        return array_map(
            function ($item) {
                return array($item["hex"], $item["hsl"]);
            },
            $this->equivalences()
        );
    }
}
