<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Converter;

use Rainbow\Converter\RgbaConverter;
use Rainbow\Hsl;
use Rainbow\Rgb;
use Rainbow\Rgba;

class RgbaConverterTest extends \PHPUnit_Framework_TestCase
{
    public function testGetColorShouldReturnRgba()
    {
        $color = new Rgba(100, 150, 200, 0.5);
        $converter = new RgbaConverter($color);

        $this->assertEquals($color, $converter->getColor());
    }

    public function testToRgbShouldReturnRgb()
    {
        $color = new Rgba(100, 150, 200, 0.5);
        $converter = new RgbaConverter($color);

        $this->assertEquals(new Rgb(100, 150, 200), $converter->toRgb());
    }

    public function testToHslShouldReturnHsl()
    {
        $color = new Rgba(255, 0, 255, 0.5);
        $converter = new RgbaConverter($color);

        $this->assertEquals(new Hsl(300, 100, 50), $converter->toHsl());
    }
}
