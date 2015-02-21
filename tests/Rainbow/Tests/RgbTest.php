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

class RgbTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptyColorShouldReturnZeros()
    {
        $color = new Rgb();

        $this->assertEquals(0, $color->getRed());
        $this->assertEquals(0, $color->getGreen());
        $this->assertEquals(0, $color->getBlue());
    }

    public function testColorShouldReturnDefinedValues()
    {
        $color = new Rgb(50, 100, 150);

        $this->assertEquals(50, $color->getRed());
        $this->assertEquals(100, $color->getGreen());
        $this->assertEquals(150, $color->getBlue());
    }

    /**
     * @dataProvider getOutOfBoundsDataProvider
     * @expectedException \OutOfBoundsException
     */
    public function testOutOfBoundsValueShouldThrowException($red, $green, $blue)
    {
        new Rgb($red, $green, $blue);
    }

    public function getOutOfBoundsDataProvider()
    {
        return array(
            array(-1, 30, 30),
            array(30, -1, 30),
            array(30, 30, -1),
            array(256, 30, 30),
            array(30, 256, 30),
            array(30, 30, 256),
        );
    }

    /**
     * @dataProvider getNonFormattedValueDataProvider
     */
    public function testNonFormattedRedValueShouldReturnNumericValue($value, $expectedValue)
    {
        $color = new Rgb($value);

        $this->assertEquals($expectedValue, $color->getRed());
        $this->assertInternalType("int", $color->getRed());
    }

    public function getNonFormattedValueDataProvider()
    {
        return array(
            array("12", 12),
            array(" 12 ", 12),
            array("\n12\t", 12),
        );
    }

    /**
     * @dataProvider getNonFormattedValueDataProvider
     */
    public function testNonFormattedGreenValueShouldReturnNumericValue($value, $expectedValue)
    {
        $color = new Rgb(0, $value);

        $this->assertEquals($expectedValue, $color->getGreen());
        $this->assertInternalType("int", $color->getGreen());
    }

    /**
     * @dataProvider getNonFormattedValueDataProvider
     */
    public function testNonFormattedBlueValueShouldReturnNumericValue($value, $expectedValue)
    {
        $color = new Rgb(0, 0, $value);

        $this->assertEquals($expectedValue, $color->getBlue());
        $this->assertInternalType("int", $color->getBlue());
    }

}
