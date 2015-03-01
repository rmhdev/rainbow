<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Unit;

use Rainbow\Unit\Percent;

class PercentTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyValueShouldReturnZero()
    {
        $unit = new Percent();

        $this->assertEquals(0, $unit->getValue());
        $this->assertInternalType("int", $unit->getValue());
    }

    /**
     * @dataProvider getCorrectValuesDataProvider
     */
    public function testCorrectValueShouldReturnValue($value, $expectedValue)
    {
        $unit = new Percent($value);

        $this->assertEquals($expectedValue, $unit->getValue());
        $this->assertInternalType("int", $unit->getValue());
    }

    public function getCorrectValuesDataProvider()
    {
        return array(
            array(20, 20),
            array("20", 20),
            array("20%", 20),
            array(20.1, 20),
            array(20.4, 20),
            array(20.5, 21),
            array(20.9, 21),
        );
    }

    /**
     * @dataProvider getOutOfBoundsDataProvider
     * @expectedException \OutOfBoundsException
     */
    public function testOutOfBoundsValueShouldThrowException($value)
    {
        new Percent($value);
    }

    public function getOutOfBoundsDataProvider()
    {
        return array(
            array(-1),
            array(101),
        );
    }

    /**
     * @dataProvider unexpectedValuesDataProvider
     * @expectedException \UnexpectedValueException
     */
    public function testUnexpectedValueShouldThrowException($value)
    {
        new Percent($value);
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
     */
    public function testToStringShouldReturnStringValue($value, $expectedValue)
    {
        $unit = new Percent($value);

        $this->assertEquals($expectedValue, (string) $unit);
    }

    public function getToStringDataProvider()
    {
        return array(
            array(0, "0%"),
            array(12, "12%"),
            array(" 100 ", "100%"),
        );
    }
}
