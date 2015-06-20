<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Converter;

use Rainbow\Converter\HslConverter;
use Rainbow\Hsl;
use Rainbow\Rgb;

class HslConverterTest extends AbstractConverterTest
{
    public function testGetColorShouldReturnHsl()
    {
        $color = new Hsl(150, 25, 75);
        $converter = new HslConverter($color);

        $this->assertEquals($color, $converter->getColor());
    }

    /**
     * @dataProvider toRgbDataProvider
     * @param Rgb $expected
     * @param Hsl $color
     */
    public function testToRgbShouldReturnRgb(Rgb $expected, Hsl $color)
    {
        $converter = new HslConverter($color);

        $this->assertEquals($expected, $converter->toRgb());
    }

    public function toRgbDataProvider()
    {
        return $this->rgbHslEquivalences();
    }

    public function testToHslShouldReturnSameColor()
    {
        $color = new Hsl(150, 25, 75);
        $converter = new HslConverter($color);

        $this->assertEquals($color, $converter->toHsl());
    }

    /**
     * @dataProvider hslRgbEquivalences
     * @param Hsl $expected
     * @param Rgb $color
     */
    public function testCreateFromRgbShouldReturnHexConverter(Hsl $expected, Rgb $color)
    {
        $converter = new HslConverter($expected);

        $this->assertEquals($converter, HslConverter::create($color));
    }

    public function testCreateFromHslShouldReturnHexConverter()
    {
        $color = new Hsl(150, 25, 75);
        $converter = new HslConverter($color);

        $this->assertEquals($converter, HslConverter::create($color));
    }
}
