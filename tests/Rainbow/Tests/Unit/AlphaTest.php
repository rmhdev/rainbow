<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Unit;

use Rainbow\Unit\Alpha;

class AlphaTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyShouldReturnZero()
    {
        $unit = new Alpha();

        $this->assertEquals(1, $unit->getValue());
        $this->assertInternalType("float", $unit->getValue());
    }

    /**
     * @dataProvider getCorrectValueDataProvider
     * @param $value
     * @param $expectedValue
     */
    public function testCorrectValueShouldReturnValue($value, $expectedValue)
    {
        $unit = new Alpha($value);

        $this->assertEquals($expectedValue, $unit->getValue());
        $this->assertInternalType("float", $unit->getValue());
    }

    public function getCorrectValueDataProvider()
    {
        return array(
            array(0, 0),
            array("1", 1),
            array("1.0", 1),
            array("0.3", 0.3),
            array(" 0.5 ", 0.5),
            array("\n0.6\t", 0.6),
            array(0.41, 0.4),
            array(0.44, 0.4),
            array(0.45, 0.5),
            array(0.49, 0.5),
        );
    }

    /**
     * @dataProvider getOutOfBoundsDataProvider
     * @expectedException \OutOfBoundsException
     * @param $value
     */
    public function testOutOfBoundsValueShouldThrowException($value)
    {
        new Alpha($value);
    }

    public function getOutOfBoundsDataProvider()
    {
        return array(
            array(-0.1),
            array(1.1),
        );
    }

    /**
     * @dataProvider unexpectedValuesDataProvider
     * @expectedException \UnexpectedValueException
     * @param $value
     */
    public function testUnexpectedValueShouldThrowException($value)
    {
        new Alpha($value);
    }

    public function unexpectedValuesDataProvider()
    {
        return array(
            array(""),
            array("a"),
            array("0,1"),
            array(null),
        );
    }

    /**
     * @dataProvider getToStringDataProvider
     * @param $value
     * @param $expectedValue
     */
    public function testToStringShouldReturnStringValue($value, $expectedValue)
    {
        $unit = new Alpha($value);

        $this->assertEquals($expectedValue, (string) $unit);
    }

    public function getToStringDataProvider()
    {
        return array(
            array(0, "0"),
            array(" 1 ", "1"),
            array(0.1, "0.1"),
            array(0.12345, "0.1"),
        );
    }
}
