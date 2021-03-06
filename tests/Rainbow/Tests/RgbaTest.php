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
use Rainbow\Rgba;
use Rainbow\Component\Alpha;
use Rainbow\Component\Rgb;

class RgbaTest extends AbstractColorTest
{
    public function testGetNameShouldReturnConstName()
    {
        $rgba = new Rgba();

        $this->assertEquals("rgba", $rgba->getName());
    }

    public function testEmptyColorShouldBeBlack()
    {
        $rgba = new Rgba();

        $empty = new Rgb();
        $this->assertEquals($empty, $rgba->getRed());
        $this->assertEquals($empty, $rgba->getGreen());
        $this->assertEquals($empty, $rgba->getBlue());
    }

    public function testEmptyColorShouldBeOpaque()
    {
        $rgba = new Rgba();

        $this->assertEquals(new Alpha(1), $rgba->getAlpha());
    }

    public function testColorShouldReturnDefinedValues()
    {
        $rgba = new Rgba(100, 150, 200, 0.5);

        $this->assertEquals(new Rgb(100), $rgba->getRed());
        $this->assertEquals(new Rgb(150), $rgba->getGreen());
        $this->assertEquals(new Rgb(200), $rgba->getBlue());
        $this->assertEquals(new Alpha(0.5), $rgba->getAlpha());
    }

    public function testCreateWithComponentsShouldReturnCorrectColor()
    {
        $color = new Rgba(new Rgb(120), new Rgb(75), new Rgb(95), new Alpha(0.5));

        $this->assertEquals(new Rgba(120, 75, 95, 0.5), $color);
    }

    /**
     * @dataProvider getToStringDataProvider
     * @param $values
     * @param $expectedValue
     */
    public function testToStringShouldReturnValidString($values, $expectedValue)
    {
        $color = new Rgba(
            $values["red"],
            $values["green"],
            $values["blue"],
            $values["alpha"]
        );

        $this->assertEquals($expectedValue, (string) $color);
    }

    public function getToStringDataProvider()
    {
        return array(
            array(
                array("red" => 0, "green" => 0, "blue" => 0, "alpha" => 1),
                "rgb(0,0,0,1)"
            ),
            array(
                array("red" => 10, "green" => 20, "blue" => 30, "alpha" => 0),
                "rgb(10,20,30,0)"
            ),
            array(
                array("red" => 255, "green" => 255, "blue" => 255, "alpha" => 0.5),
                "rgb(255,255,255,0.5)"
            ),
        );
    }

    /**
     * {@inheritDoc}
     * @return Rgba
     */
    protected function toCurrent(Hsl $color)
    {
        $rgb = $color->translate()->toRgb();

        return new Rgba(
            $rgb->getRed(),
            $rgb->getGreen(),
            $rgb->getBlue(),
            new Alpha(1)
        );
    }
}
