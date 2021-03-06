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
use Rainbow\Component\Alpha;
use Rainbow\Component\Angle;
use Rainbow\Component\Percent;

class HslTest extends AbstractColorTest
{
    public function testGetNameShouldReturnConstName()
    {
        $color = new Hsl(0, 0, 0);

        $this->assertEquals("hsl", $color->getName());
    }

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

    public function testCreateWithComponentsShouldReturnCorrectColor()
    {
        $color = new Hsl(new Angle(120), new Percent(75), new Percent(95));

        $this->assertEquals(new Hsl(120, 75, 95), $color);
    }

    /**
     * @dataProvider getToStringDataProvider
     * @param $values
     * @param $expectedValue
     */
    public function testToStringShouldReturnValidString($values, $expectedValue)
    {
        $color = new Hsl(
            $values["hue"],
            $values["saturation"],
            $values["lightness"]
        );

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

    /**
     * {@inheritDoc}
     * @return Hsl
     */
    protected function toCurrent(Hsl $color)
    {
        return $color;
    }
}
