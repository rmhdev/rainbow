<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Converter;

use Rainbow\Converter\HslaConverter;
use Rainbow\Hsl;
use Rainbow\Hsla;
use Rainbow\Rgb;
use Rainbow\Rgba;

class HslaConverterTest extends \PHPUnit_Framework_TestCase
{
    public function testGetColorShouldReturnHsla()
    {
        $color = new Hsla(180, 50, 75, 0.5);
        $converter = new HslaConverter($color);

        $this->assertEquals($color, $converter->getColor());
    }

    public function testToRgbShouldReturnRgb()
    {
        $color = new Hsla(0, 0, 0, 0.5);
        $converter = new HslaConverter($color);

        $this->assertEquals(new Rgb(0, 0, 0), $converter->toRgb());
    }

    public function testToHslShouldReturnHsl()
    {
        $color = new Hsla(120, 55, 80, 0.5);
        $converter = new HslaConverter($color);

        $this->assertEquals(new Hsl(120, 55, 80), $converter->toHsl());
    }

    public function testCreateWithHslShouldReturnHslaConverter()
    {
        $color = new Hsl(300, 100, 50);
        $converter = new HslaConverter(new Hsla(300, 100, 50, 1));

        $this->assertEquals($converter, HslaConverter::create($color));
    }

    public function testCreateWithHslaShouldReturnHslaConverter()
    {
        $color = new Hsla(100, 60, 80, 0.5);
        $converter = new HslaConverter($color);

        $this->assertEquals($converter, HslaConverter::create($color));
    }

    public function testCreateWithRgbShouldReturnHslaConverter()
    {
        $color = new Rgb(255, 128, 0);
        $converter = new HslaConverter(new Hsla(30, 100, 50, 1));

        $this->assertEquals($converter, HslaConverter::create($color));
    }

    public function testCreateWithRgbaShouldReturnHslaConverter()
    {
        $color = new Rgba(255, 128, 0, 0.25);
        $converter = new HslaConverter(new Hsla(30, 100, 50, 0.25));

        $this->assertEquals($converter, HslaConverter::create($color));
    }
}
