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
    /**
     * @dataProvider toRgbDataProvider
     * @param Rgb $expected
     * @param Hsl $color
     */
    public function testToRgbShouldReturnRgb(Rgb $expected, Hsl $color)
    {
        $this->assertEquals($expected, HslConverter::toRgb($color));
    }

    public function toRgbDataProvider()
    {
        return $this->rgbHslEquivalences();
    }

    /**
     * @dataProvider fromRgbDataProvider
     * @param Hsl $expected
     * @param Rgb $color
     */
    public function testFromRgbShouldReturnHsl(Hsl $expected, Rgb $color)
    {
        $this->assertEquals($expected, HslConverter::fromRgb($color));
    }

    public function fromRgbDataProvider()
    {
        return $this->hslRgbEquivalences();
    }
}
