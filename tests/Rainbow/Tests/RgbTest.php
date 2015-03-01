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

class RgbTest extends AbstractColorTest
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
    public function testToStringShouldReturnValidString($values, $expectedValue)
    {
        $color = $this->createRgb($values);

        $this->assertEquals($expectedValue, (string) $color);
    }

    public function getToStringDataProvider()
    {
        return array(
            array(
                array("red" => 0, "green" => 0, "blue" => 0),
                "rgb(0,0,0)"
            ),
            array(
                array("red" => 10, "green" => 20, "blue" => 30),
                "rgb(10,20,30)"
            ),
            array(
                array("red" => 255, "green" => 255, "blue" => 255),
                "rgb(255,255,255)"
            ),
        );
    }

    public function testAlphaShouldReturnTotalOpacity()
    {
        $color = new Rgb();
        $alpha = new Alpha(1);

        $this->assertEquals($alpha, $color->getAlpha());
    }

    public function testRgbToHslShouldReturnHslColor()
    {
        $rgb = new Rgb(0, 0, 0);
        $hsl = new Hsl(0, 0, 0);

        $this->assertEquals((string)$hsl, (string)$rgb->toHsl());
    }

    public function testSaturateShouldIncreaseSaturationInNewColor()
    {
        $rgb = new Rgb(128, 230, 26);

        $this->assertEquals(new Rgb(128, 255, 0), $rgb->saturate(20));
        $this->assertEquals("rgb(128,230,26)", (string)$rgb);
    }

    public function testSaturateShouldBeLesserEqualThan100()
    {
        $rgb = new Rgb(128, 230, 26); //80% saturation

        $this->assertEquals("100%", (string)$rgb->saturate(30)->toHsl()->getSaturation());
    }

    public function testToRgbShouldReturnEqualColor()
    {
        $rgb = new Rgb(128, 230, 26);

        $this->assertEquals($rgb, $rgb->toRgb());
    }

    public function testDesaturateShouldDecreaseSaturationInNewColor()
    {
        $rgb = new Rgb(128, 230, 26); //80% saturation

        $this->assertEquals(new Rgb(128, 204, 51), $rgb->desaturate(20));
        $this->assertEquals("rgb(128,230,26)", (string)$rgb);
    }

    public function testDesaturateShouldBeLesserEqualThanZero()
    {
        $rgb = new Rgb(128, 230, 26); //80% saturation

        $this->assertEquals("0%", (string)$rgb->desaturate(90)->toHsl()->getSaturation());
    }

    public function testLightenShouldIncreaseLightnessInNewColor()
    {
        $rgb = new Rgb(128, 128, 128); //50% lightness

        $this->assertEquals(new Rgb(191, 191, 191), $rgb->lighten(25));
        $this->assertEquals("rgb(128,128,128)", (string)$rgb);
    }

    public function testLightenShouldBeLesserEqualThan100()
    {
        $rgb = new Rgb(128, 128, 128); //50% lightness

        $this->assertEquals("100%", (string)$rgb->lighten(60)->toHsl()->getLightness());
    }
}
