<?php

namespace Rainbow\Tests\Unit;

use Rainbow\Unit\Numerical;

class NumericalTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyShouldReturnZero()
    {
        $unit = new Numerical();

        $this->assertEquals(0, $unit->getInt());
    }

    public function testCorrectValueShouldReturnValue()
    {
        $unit = new Numerical(30);

        $this->assertEquals(30, $unit->getInt());
    }

    /**
     * @dataProvider getCorrectStringValueDataProvider
     */
    public function testCorrectStringShouldReturnValue($value, $expectedValue)
    {
        $unit = new Numerical($value);

        $this->assertEquals($expectedValue, $unit->getInt());
        $this->assertInternalType("int", $unit->getInt());
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
        new Numerical($value);
    }

    public function getOutOfBoundsDataProvider()
    {
        return array(
            array(-1),
            array(256),
        );
    }
}

