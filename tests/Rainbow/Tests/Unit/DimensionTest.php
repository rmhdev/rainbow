<?php

namespace Rainbow\Tests\Unit;

use Rainbow\Unit\Dimension;

class DimensionTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyShouldReturnZero()
    {
        $unit = new Dimension();

        $this->assertEquals(0, $unit->getValue());
    }

    public function testCorrectValueShouldReturnValue()
    {
        $unit = new Dimension(30);

        $this->assertEquals(30, $unit->getValue());
    }

    /**
     * @dataProvider getCorrectStringValueDataProvider
     */
    public function testCorrectStringShouldReturnValue($value, $expectedValue)
    {
        $unit = new Dimension($value);

        $this->assertEquals($expectedValue, $unit->getValue());
        $this->assertInternalType("int", $unit->getValue());
    }

    public function getCorrectStringValueDataProvider()
    {
        return array(
            array("12", 12),
            array(" 12 ", 12),
            array("\n12\t", 12),
        );
    }

    /**
     * @dataProvider getOutOfBoundsDataProvider
     * @expectedException \OutOfBoundsException
     */
    public function testOutOfBoundsValueShouldThrowException($value)
    {
        new Dimension($value);
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
     */
    public function testUnexpectedValueShouldThrowException($value)
    {
        new Dimension($value);
    }

    public function unexpectedValuesDataProvider()
    {
        return array(
            array(""),
            array("a"),
            array("10,0"),
        );
    }
}

