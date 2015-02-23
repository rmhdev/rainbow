<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests;

use Rainbow\Rgb;
use Rainbow\Unit\Dimension;

class RgbTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptyColorShouldReturnZeros()
    {
        $color = new Rgb();

        $empty = new Dimension();
        $this->assertEquals($empty, $color->getRed());
        $this->assertEquals($empty, $color->getGreen());
        $this->assertEquals($empty, $color->getBlue());
    }

    public function testColorShouldReturnDefinedValues()
    {
        $color = new Rgb(50, 100, 150);

        $this->assertEquals(new Dimension(50), $color->getRed());
        $this->assertEquals(new Dimension(100), $color->getGreen());
        $this->assertEquals(new Dimension(150), $color->getBlue());
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
            array(0, 0, 0, "rgb(0, 0, 0)"),
            array(10, 20, 30, "rgb(10, 20, 30)"),
            array(255, 255, 255, "rgb(255, 255, 255)"),
        );
    }

}
