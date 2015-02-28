<?php

namespace Rainbow\Tests;

use Rainbow\Hsl;
use Rainbow\Rgb;
use Rainbow\Unit\Alpha;
use Rainbow\Unit\Angle;
use Rainbow\Unit\Percent;

class HslTest extends AbstractColorTest
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
    public function testToStringShouldReturnValidString($values, $expectedValue)
    {
        $color = $this->createHsl($values);

        $this->assertEquals($expectedValue, (string) $color);
    }

    public function getToStringDataProvider()
    {
        return array(
            array(
                array("hue" => 0, "saturation" => 0, "lightness" => 0),
                "hsl(0,0%,0%)"
            ),
            array(
                array("hue" => 10, "saturation" => 20, "lightness" => 30),
                "hsl(10,20%,30%)"
            ),
            array(
                array("hue" => 370, "saturation" => 100, "lightness" => 100),
                "hsl(10,100%,100%)"
            ),
        );
    }

    public function testAlphaShouldReturnTotalOpacity()
    {
        $color = new Hsl(10, 20, 30);
        $alpha = new Alpha(1);

        $this->assertEquals($alpha, $color->getAlpha());
    }


    public function testHslToRgbShouldReturnEquivalentColor()
    {
        $hsl = new Hsl(0, 0, 0);
        $expectedRgb = new Rgb(0, 0, 0);

        $this->assertEquals((string)$expectedRgb, (string)$hsl->toRgb());
    }

    public function testSaturateShouldIncreaseSaturationInNewHsl()
    {
        $hsl = new Hsl(0, 0, 0);
        $newHsl = $hsl->saturate(10);

        $this->assertEquals(new Percent(0), $hsl->getSaturation());
        $this->assertEquals(new Percent(10), $newHsl->getSaturation());
    }

    public function testSaturateShouldBeLessEqualThan100()
    {
        $hsl = new Hsl(0, 80, 0);

        $this->assertEquals("100%", (string)$hsl->saturate(30)->getSaturation());
    }

    public function testToHslMustReturnEqualColor()
    {
        $color = new Hsl(10, 20, 30);

        $this->assertEquals($color, $color->toHsl());
    }

    public function testDesaturateShouldDecreaseSaturationInNewHsl()
    {
        $hsl = new Hsl(0, 80, 0);
        $newHsl = $hsl->desaturate(10);

        $this->assertEquals(new Percent(80), $hsl->getSaturation());
        $this->assertEquals(new Percent(70), $newHsl->getSaturation());
    }

    public function testDesaturateShouldBeGreaterEqualThanZero()
    {
        $hsl = new Hsl(0, 20, 0);

        $this->assertEquals("0%", (string)$hsl->desaturate(30)->getSaturation());
    }
}
