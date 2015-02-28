<?php

namespace Rainbow\Tests;

use Rainbow\Hsl;
use Rainbow\Rgb;
use Rainbow\Unit\Alpha;
use Rainbow\Unit\Angle;
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

    public function testHslToRgbShouldReturnEquivalentColor()
    {
        $hsl = new Hsl(0, 0, 0);
        $expectedRgb = new Rgb(0, 0, 0);

        $this->assertEquals((string)$expectedRgb, (string)$hsl->toRgb());
    }
}
