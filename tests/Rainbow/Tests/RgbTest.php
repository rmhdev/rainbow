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
use Rainbow\Component\Alpha;
use Rainbow\Component\Rgb as RgbComponent;

class RgbTest extends AbstractColorTest
{
    public function testGetNameShouldReturnConstName()
    {
        $color = new Rgb(0, 0, 0);

        $this->assertEquals("rgb", $color->getName());
    }

    public function testEmptyColorShouldReturnZeros()
    {
        $color = new Rgb();

        $this->assertEquals(new RgbComponent(), $color->getRed());
        $this->assertEquals(new RgbComponent(), $color->getGreen());
        $this->assertEquals(new RgbComponent(), $color->getBlue());
    }

    public function testColorShouldReturnDefinedValues()
    {
        $color = new Rgb(50, 100, 150);

        $this->assertEquals(new RgbComponent(50), $color->getRed());
        $this->assertEquals(new RgbComponent(100), $color->getGreen());
        $this->assertEquals(new RgbComponent(150), $color->getBlue());
    }

    public function testCreateWithComponentsShouldReturnCorrectColor()
    {
        $color = new Rgb(new RgbComponent(120), new RgbComponent(75), new RgbComponent(95));

        $this->assertEquals(new Rgb(120, 75, 95), $color);
    }

    /**
     * @dataProvider getToStringDataProvider
     * @param $values
     * @param $expectedValue
     */
    public function testToStringShouldReturnValidString($values, $expectedValue)
    {
        $color = new Rgb(
            $values["red"],
            $values["green"],
            $values["blue"]
        );

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

    /**
     * {@inheritDoc}
     * @return Rgb
     */
    protected function toCurrent(Hsl $color)
    {
        return $color->translate()->toRgb();
    }
}
