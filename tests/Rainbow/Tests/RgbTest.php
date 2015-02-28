<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests;

use Rainbow\Hsl;
use Rainbow\Rgb;
use Rainbow\Unit\Alpha;
use Rainbow\Unit\Component;

class RgbTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptyColorShouldReturnZeros()
    {
        $color = new Rgb();

        $empty = new Component();
        $this->assertEquals($empty, $color->getRed());
        $this->assertEquals($empty, $color->getGreen());
        $this->assertEquals($empty, $color->getBlue());
    }

    public function testColorShouldReturnDefinedValues()
    {
        $color = new Rgb(50, 100, 150);

        $this->assertEquals(new Component(50), $color->getRed());
        $this->assertEquals(new Component(100), $color->getGreen());
        $this->assertEquals(new Component(150), $color->getBlue());
    }

    /**
     * @dataProvider getToStringDataProvider
     */
    public function testToStringShouldReturnValidString($red, $green, $blue, $expectedValue)
    {
        $color = new Rgb($red, $green, $blue);

        $this->assertEquals($expectedValue, (string) $color);
    }

    public function getToStringDataProvider()
    {
        return array(
            array(0, 0, 0, "rgb(0,0,0)"),
            array(10, 20, 30, "rgb(10,20,30)"),
            array(255, 255, 255, "rgb(255,255,255)"),
        );
    }

    public function testAlphaShouldReturnTotalOpacity()
    {
        $color = new Rgb();
        $alpha = new Alpha(1);

        $this->assertEquals($alpha, $color->getAlpha());
    }

    /**
     * @dataProvider getToHslDataProvider
     */
    public function testRgbToHslShouldReturnEquivalentColor($red, $green, $blue, $hue, $saturation, $lightness)
    {
        $rgb = new Rgb($red, $green, $blue);
        $hsl = new Hsl($hue, $saturation, $lightness);

        $this->assertEquals((string) $hsl, (string)$rgb->toHsl());
    }

    public function getToHslDataProvider()
    {
        return array(
            array(0, 0, 0, 0, 0, 0),
            array(255, 255, 255, 0, 0, 100),
            array(255, 255, 0, 60, 100, 50),
            array(255, 0, 255, 300, 100, 50),
            array(0, 128, 0, 120, 100, 25),
            array(128, 0, 128, 300, 100, 25),
        );
    }
}
