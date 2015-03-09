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
use Rainbow\Unit\Percent;

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

    /**
     * {@inheritDoc}
     * @return Rgb
     */
    protected function toCurrent(Hsl $color)
    {
        return $color->getTranslator()->toRgb();
    }

    /**
     * {@inheritDoc}
     * @return Rgb
     */
    protected function createColor()
    {
        return new Rgb(0, 0, 0);
    }

    public function testLuminanceInBlackShouldReturnZero()
    {
        $rgb = new Rgb(0, 0, 0);

        $this->assertEquals(new Percent(0), $rgb->luminance());
    }

    public function testLuminanceInWhiteShouldReturn100()
    {
        $rgb = new Rgb(255, 255, 255);

        $this->assertEquals(new Percent(100), $rgb->luminance());
    }
}
