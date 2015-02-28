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
use Rainbow\Unit\Angle;
use Rainbow\Unit\Component;
use Rainbow\Unit\Percent;

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
     * @dataProvider getRgbHslEquivalenceDataProvider
     */
    public function testRgbToHslShouldReturnEquivalentColor($rgbValue, $hslValue)
    {
        $rgb = new Rgb(
            $rgbValue["red"],
            $rgbValue["green"],
            $rgbValue["blue"]
        );
        $hsl = new Hsl(
            $hslValue["hue"],
            $hslValue["saturation"],
            $hslValue["lightness"]
        );

        $this->assertEquals((string)$hsl, (string)$rgb->toHsl());
    }

    /**
     * @dataProvider getRgbHslEquivalenceDataProvider
     */
    public function testGetHueShouldReturnAngle($rgbValue, $hslValue)
    {
        $rgb = new Rgb(
            $rgbValue["red"],
            $rgbValue["green"],
            $rgbValue["blue"]
        );

        $this->assertEquals(new Angle($hslValue["hue"]), $rgb->getHue());
    }

    /**
     * @dataProvider getRgbHslEquivalenceDataProvider
     */
    public function testGetSaturationShouldReturnPercent($rgbValue, $hslValue)
    {
        $rgb = new Rgb(
            $rgbValue["red"],
            $rgbValue["green"],
            $rgbValue["blue"]
        );

        $this->assertEquals(new Percent($hslValue["saturation"]), $rgb->getSaturation());
    }

    /**
     * @dataProvider getRgbHslEquivalenceDataProvider
     */
    public function testGetLightnessShouldReturnPercent($rgbValue, $hslValue)
    {
        $rgb = new Rgb(
            $rgbValue["red"],
            $rgbValue["green"],
            $rgbValue["blue"]
        );

        $this->assertEquals(new Percent($hslValue["lightness"]), $rgb->getLightness());
    }

    public function testSaturateShouldIncreaseSaturationInNewRgb()
    {
        $rgb = new Rgb(128, 230, 26);

        $this->assertEquals(new Rgb(128, 255, 0), $rgb->saturate(20));
        $this->assertEquals("rgb(128,230,26)", (string)$rgb);
    }

    public function testSaturateShouldPassBeLessEqualThan100()
    {
        $rgb = new Rgb(128, 230, 26); //80% saturation

        $this->assertEquals("100%", (string)$rgb->saturate(30)->toHsl()->getSaturation());
    }

    public function testToRgbShouldReturnEqualColor()
    {
        $rgb = new Rgb(128, 230, 26);

        $this->assertEquals($rgb, $rgb->toRgb());
    }
}
