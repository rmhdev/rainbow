<?php

namespace Rainbow\Tests\Unit;

use Rainbow\Unit\Angle;

class AngleTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyShouldReturnZero()
    {
        $angle = new Angle();

        $this->assertEquals(0, $angle->getValue());
        $this->assertInternalType("int", $angle->getValue());
    }

    /**
     * @dataProvider getCorrectValueDataProvider
     */
    public function testCorrectValueShouldReturnValue($value, $expectedValue)
    {
        $unit = new Angle($value);

        $this->assertEquals($expectedValue, $unit->getValue());
        $this->assertInternalType("int", $unit->getValue());
    }

    public function getCorrectValueDataProvider()
    {
        return array(
            array(0, 0),
            array(15, 15),
            array("359", 359),
            array("\t50\n", 50),
            array(123.1, 123),
            array(123.4, 123),
            array(123.5, 124),
            array(123.9, 124),
        );
    }

    /**
     * @dataProvider getOutOfBoundsDataProvider
     */
    public function testOutOfBoundsValueShouldBeCorrected($value, $expectedValue)
    {
        $unit = new Angle($value);

        $this->assertEquals($expectedValue, $unit->getValue());
    }

    public function getOutOfBoundsDataProvider()
    {
        return array(
            array(-10, 350),
            array(450, 90),
        );
    }

    /**
     * @dataProvider unexpectedValuesDataProvider
     * @expectedException \UnexpectedValueException
     */
    public function testUnexpectedValueShouldThrowException($value)
    {
        new Angle($value);
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
     */
    public function testToStringShouldReturnStringValue($value, $expectedValue)
    {
        $unit = new Angle($value);

        $this->assertEquals($expectedValue, (string) $unit);
    }

    public function getToStringDataProvider()
    {
        return array(
            array(0, "0"),
            array(" 1 ", "1"),
            array("700", "340"),
            array(-100, "260"),
        );
    }
}
