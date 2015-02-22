<?php

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
            array("20.1", 20),
            array("20.9", 20),
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
}
