<?php

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
        );
    }
}
