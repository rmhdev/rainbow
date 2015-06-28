<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Converter;

use Rainbow\Converter\RgbConverter;
use Rainbow\Hsl;
use Rainbow\Rgb;

class RgbConverterTest extends AbstractConverterTest
{
    public function testGetColorShouldReturnRgb()
    {
        $color = new Rgb(100, 150, 200);
        $converter = new RgbConverter($color);

        $this->assertEquals($color, $converter->getColor());
    }

    public function testToRgbShouldReturnRgb()
    {
        $color = new Rgb(100, 150, 200);
        $converter = new RgbConverter($color);

        $this->assertEquals($color, $converter->toRgb($color));
    }

    /**
     * @dataProvider hslRgbEquivalences
     * @param Hsl $expected
     * @param Rgb $rgb
     */
    public function testToHslShouldReturnHsl(Hsl $expected, Rgb $rgb)
    {
        $converter = new RgbConverter($rgb);

        $this->assertEquals($expected, $converter->toHsl());
    }

    public function hslRgbEquivalences()
    {
        return $this->getEquivalences("hsl", "rgb");
    }

    /**
     * @dataProvider hslRgbEquivalences
     * @param Hsl $hsl
     * @param Rgb $rgb
     */
    public function testCreateFromHslShouldReturnRgbConverter(Hsl $hsl, Rgb $rgb)
    {
        $converter = new RgbConverter($rgb);

        $this->assertEquals($converter, RgbConverter::create($hsl));
    }

    public function testCreateFromRgbColorShouldReturnRgbConverter()
    {
        $rgb = new Rgb(100, 150, 200);
        $converter = new RgbConverter($rgb);

        $this->assertEquals($converter, RgbConverter::create($rgb));
    }
}
