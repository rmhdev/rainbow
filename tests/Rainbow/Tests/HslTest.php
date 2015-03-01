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

    public function testToHslMustReturnEqualColor()
    {
        $color = new Hsl(10, 20, 30);

        $this->assertEquals($color, $color->toHsl());
    }

    /**
     * {@inheritDoc}
     * @return Hsl
     */
    protected function toCurrent(Hsl $color)
    {
        return $color;
    }

    public function testDarkenShouldDecreaseLightnessInNewColor()
    {
        $hsl = new Hsl(90, 80, 50);
        $newColor = $hsl->darken(30);

        $this->assertEquals(new Percent(50), $hsl->getLightness());
        $this->assertEquals(new Percent(20), $newColor->getLightness());
    }

    public function testDarkenShouldBeGreaterEqualThanZero()
    {
        $hsl = new Hsl(90, 80, 50);
        $newColor = $hsl->darken(60);

        $this->assertEquals("0%", (string)$newColor->getLightness());
    }
}
