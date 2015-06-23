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
use Rainbow\Hsla;
use Rainbow\Unit\Alpha;
use Rainbow\Unit\Angle;
use Rainbow\Unit\Percent;

class HslaTest extends AbstractColorTest
{
    public function testGetNameShouldReturnConstName()
    {
        $color = new Hsla();

        $this->assertEquals("hsla", $color->getName());
    }

    public function testEmptyColorShouldReturnBlack()
    {
        $color = new Hsla();

        $this->assertEquals(new Angle(0), $color->getHue());
        $this->assertEquals(new Percent(0), $color->getSaturation());
        $this->assertEquals(new Percent(0), $color->getLightness());
    }

    public function testEmptyColorShouldBeOpaque()
    {
        $color = new Hsla();

        $this->assertEquals(new Alpha(1), $color->getAlpha());
    }

    public function testColorShouldReturnDefinedValues()
    {
        $color = new Hsla(180, 25, 75, 0.5);

        $this->assertEquals(new Angle(180), $color->getHue());
        $this->assertEquals(new Percent(25), $color->getSaturation());
        $this->assertEquals(new Percent(75), $color->getLightness());
        $this->assertEquals(new Alpha(0.5), $color->getAlpha());
    }

    public function testCreateWithUnitsShouldReturnCorrectColor()
    {
        $color = new Hsla(new Angle(120), new Percent(75), new Percent(95), new Alpha(0.5));

        $this->assertEquals(new Hsla(120, 75, 95, 0.5), $color);
    }

    /**
     * @dataProvider getToStringDataProvider
     * @param $values
     * @param $expectedValue
     */
    public function testToStringShouldReturnValidString($values, $expectedValue)
    {
        $color = new Hsla(
            $values["hue"],
            $values["saturation"],
            $values["lightness"],
            $values["alpha"]
        );

        $this->assertEquals($expectedValue, (string) $color);
    }

    public function getToStringDataProvider()
    {
        return array(
            array(
                array("hue" => 0, "saturation" => 0, "lightness" => 0, "alpha" => 1),
                "hsla(0,0%,0%,1)"
            ),
            array(
                array("hue" => 10, "saturation" => 20, "lightness" => 30, "alpha" => 0),
                "hsla(10,20%,30%,0)"
            ),
            array(
                array("hue" => 255, "saturation" => 75, "lightness" => 96, "alpha" => 0.5),
                "hsla(255,75%,96%,0.5)"
            ),
        );
    }

    /**
     * {@inheritDoc}
     * @return Hsla
     */
    protected function toCurrent(Hsl $color)
    {
        return new Hsla(
            $color->getHue(),
            $color->getSaturation(),
            $color->getLightness(),
            $color->getAlpha()
        );
    }
}
