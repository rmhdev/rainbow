<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Unit;

use Rainbow\Unit\Angle;

class AngleTest extends AbstractUnitTest
{
    public function testEmptyShouldReturnZero()
    {
        $angle = $this->createEmptyUnit();

        $this->assertEquals(0, $angle->getValue());
        $this->assertInternalType("int", $angle->getValue());
    }

    protected function createEmptyUnit()
    {
        return new Angle();
    }

    protected function expectedMaxValue()
    {
        return 360;
    }

    /**
     * @dataProvider getCorrectValueDataProvider
     * @param $value
     * @param $expectedValue
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
     * @param $value
     * @param $expectedValue
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
     * @param $value
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
     * @param $value
     * @param $expectedValue
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
