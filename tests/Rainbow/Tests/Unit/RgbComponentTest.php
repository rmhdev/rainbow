<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Unit;

use Rainbow\Unit\RgbComponent;

class RgbComponentTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyShouldReturnZero()
    {
        $unit = new RgbComponent();

        $this->assertEquals(0, $unit->getValue());
    }

    /**
     * @dataProvider getCorrectValueDataProvider
     * @param $expectedValue
     * @param $value
     */
    public function testCorrectValueShouldReturnValue($expectedValue, $value)
    {
        $unit = new RgbComponent($value);

        $this->assertEquals($expectedValue, $unit->getValue());
    }

    public function getCorrectValueDataProvider()
    {
        return array(
            array(30, 30),
            array(127, 127.1),
            array(127, 127.4),
            array(128, 127.5),
            array(128, 127.6),
            array(128, 127.9),
        );
    }

    /**
     * @dataProvider getCorrectStringValueDataProvider
     * @param $expectedValue
     * @param $value
     */
    public function testCorrectStringShouldReturnValue($expectedValue, $value)
    {
        $unit = new RgbComponent($value);

        $this->assertEquals($expectedValue, $unit->getValue());
        $this->assertInternalType("int", $unit->getValue());
    }

    public function getCorrectStringValueDataProvider()
    {
        return array(
            array(12, "12"),
            array(12, " 12 "),
            array(12, "\n12\t"),
        );
    }

    /**
     * @dataProvider getOutOfBoundsDataProvider
     * @expectedException \OutOfBoundsException
     * @param $value
     */
    public function testOutOfBoundsValueShouldThrowException($value)
    {
        new RgbComponent($value);
    }

    public function getOutOfBoundsDataProvider()
    {
        return array(
            array(-1),
            array(256),
        );
    }

    /**
     * @dataProvider unexpectedValuesDataProvider
     * @expectedException \UnexpectedValueException
     * @param $value
     */
    public function testUnexpectedValueShouldThrowException($value)
    {
        new RgbComponent($value);
    }

    public function unexpectedValuesDataProvider()
    {
        return array(
            array(""),
            array("a"),
            array("10,0"),
            array(null),
        );
    }

    /**
     * @dataProvider getToStringDataProvider
     * @param $expectedValue
     * @param $value
     */
    public function testToStringShouldReturnStringValue($expectedValue, $value)
    {
        $unit = new RgbComponent($value);

        $this->assertEquals($expectedValue, (string) $unit);
    }

    public function getToStringDataProvider()
    {
        return array(
            array("0", 0),
            array("12", 12),
            array("12", " 12 "),
        );
    }

    /**
     * @dataProvider getPercentValueDataProvider
     * @param $expectedValue
     * @param $value
     */
    public function testPercentValuesShouldBeTransformed($expectedValue, $value)
    {
        $unit = new RgbComponent($value);

        $this->assertEquals($expectedValue, $unit->getValue());
    }

    public function getPercentValueDataProvider()
    {
        return array(
            array(255, "100%"),
            array(0, "0%"),
            array(128, "50%"),
            array(191, "75%"),
            array(64, "25%"),
        );
    }
}
