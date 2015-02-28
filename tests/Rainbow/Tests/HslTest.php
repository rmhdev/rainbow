<?php

namespace Rainbow\Tests;

use Rainbow\Hsl;
use Rainbow\Rgb;
use Rainbow\Unit\Alpha;
use Rainbow\Unit\Angle;
use Rainbow\Unit\Component;
use Rainbow\Unit\Percent;

class HslTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyColorShouldReturnBlack()
    {
        $color = new Hsl();

        $this->assertEquals(new Angle(0), $color->getHue());
        $this->assertEquals(new Percent(0), $color->getSaturation());
        $this->assertEquals(new Percent(0), $color->getLightness());
    }

    public function testColorShouldReturnDefinedValues()
    {
        $color = new Hsl(20, 30, 40);

        $this->assertEquals(new Angle(20), $color->getHue());
        $this->assertEquals(new Percent(30), $color->getSaturation());
        $this->assertEquals(new Percent(40), $color->getLightness());
    }

    /**
     * @dataProvider getToStringDataProvider
     */
    public function testToStringShouldReturnValidString($hue, $saturation, $lightness, $expectedValue)
    {
        $color = new Hsl($hue, $saturation, $lightness);

        $this->assertEquals($expectedValue, (string) $color);
    }

    public function getToStringDataProvider()
    {
        return array(
            array(0, 0, 0, "hsl(0,0%,0%)"),
            array(10, 20, 30, "hsl(10,20%,30%)"),
            array(370, 100, 100, "hsl(10,100%,100%)"),
        );
    }

    public function testAlphaShouldReturnTotalOpacity()
    {
        $color = new Hsl(10, 20, 30);
        $alpha = new Alpha(1);

        $this->assertEquals($alpha, $color->getAlpha());
    }

    /**
     * @dataProvider getToRgbDataProvider
     */
    public function testHslToRgbShouldReturnEquivalentColor($expected, $value)
    {
        $hsl = new Hsl(
            $value["hue"],
            $value["saturation"],
            $value["lightness"]
        );
        $expectedRgb = new Rgb(
            $expected["red"],
            $expected["green"],
            $expected["blue"]
        );

        $this->assertEquals((string)$expectedRgb, (string)$hsl->toRgb());
    }

    public function getToRgbDataProvider()
    {
        return array(
            array(
                array("red" => 0, "green" => 0, "blue" => 0),
                array("hue" => 0, "saturation" => 0, "lightness" => 0)
            ),
            array(
                array("red" => 255, "green" => 0, "blue" => 255),
                array("hue" => 300, "saturation" => 100, "lightness" => 50)
            ),
            array(
                array("red" => 0, "green" => 128, "blue" => 0),
                array("hue" => 120, "saturation" => 100, "lightness" => 25)
            ),
            array(
                array("red" => 255, "green" => 128, "blue" => 0),
                array("hue" => 30, "saturation" => 100, "lightness" => 50)
            ),
        );
    }

    /**
     * @dataProvider getRedDataProvider
     */
    public function testGetRedShouldReturnComponent($expected, $colorValue)
    {
        $hsl = new Hsl(
            $colorValue["hue"],
            $colorValue["saturation"],
            $colorValue["lightness"]
        );

        $this->assertEquals(new Component($expected), $hsl->getRed());
    }

    public function getRedDataProvider()
    {
        return array(
            array(0, array("hue" => 0, "saturation" => 0, "lightness" => 0)),
            array(255, array("hue" => 300, "saturation" => 100, "lightness" => 50)),
        );
    }
}
