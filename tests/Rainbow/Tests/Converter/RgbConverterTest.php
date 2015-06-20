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

class RgbConverterTest extends \PHPUnit_Framework_TestCase
{
    public function testToRgbShouldReturnRgb()
    {
        $color = new Rgb(100, 150, 200);
        $converter = new RgbConverter($color);

        $this->assertEquals($color, $converter->toRgb($color));
    }

    /**
     * @dataProvider toHslDataProvider
     * @param Hsl $expected
     * @param Rgb $rgb
     */
    public function testToHslShouldReturnHsl(Hsl $expected, Rgb $rgb)
    {
        $converter = new RgbConverter($rgb);

        $this->assertEquals($expected, $converter->toHsl());
    }

    public function toHslDataProvider()
    {
        return array(
            array(new Hsl(0, 0, 0), new Rgb(0, 0, 0)),
            array(new Hsl(300, 100, 50), new Rgb(255, 0, 255)),
            array(new Hsl(120, 100, 25), new Rgb(0, 128, 0)),
            array(new Hsl(30, 100, 50), new Rgb(255, 128, 0)),
            array(new Hsl(210, 100, 50), new Rgb(0, 128, 255)),
            array(new Hsl(90, 80, 50), new Rgb(128, 230, 26)),
        );
    }

    public function testCreateFromRgbShouldReturnRgbConverter()
    {
        $rgb = new Rgb(100, 150, 200);
        $converter = new RgbConverter($rgb);

        $this->assertEquals($converter, RgbConverter::createFromRgb($rgb));
    }

    /**
     * @dataProvider toHslDataProvider
     * @param Hsl $hsl
     * @param Rgb $rgb
     */
    public function testCreateFromHslShouldReturnRgbConverter(Hsl $hsl, Rgb $rgb)
    {
        $converter = new RgbConverter($rgb);

        $this->assertEquals($converter, RgbConverter::createFromHsl($hsl));
    }
}
