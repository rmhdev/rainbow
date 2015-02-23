<?php

namespace Rainbow\Tests\Unit;

use Rainbow\Unit\Component;

class ComponentTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyShouldReturnZero()
    {
        $unit = new Component();

        $this->assertEquals(0, $unit->getValue());
    }

    public function testCorrectValueShouldReturnValue()
    {
        $unit = new Component(30);

        $this->assertEquals(30, $unit->getValue());
    }

    /**
     * @dataProvider getCorrectStringValueDataProvider
     */
    public function testCorrectStringShouldReturnValue($value, $expectedValue)
    {
        $unit = new Component($value);

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
        new Component($value);
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
        new Component($value);
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
        $unit = new Component($value);

        $this->assertEquals($expectedValue, (string) $unit);
    }

    public function getToStringDataProvider()
    {
        return array(
            array(0, "0"),
            array(12, "12"),
            array(" 12 ", "12"),
        );
    }

    /**
     * @dataProvider getPercentValueDataProvider
     */
    public function testPercentValuesShouldBeTransformed($value, $expectedValue)
    {
        $unit = new Component($value);

        $this->assertEquals($expectedValue, $unit->getValue());
    }

    public function getPercentValueDataProvider()
    {
        return array(
            array("100%", 255),
            array("0%", 0),
            array("50%", 127),
        );
    }
}


