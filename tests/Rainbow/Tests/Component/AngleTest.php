<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Component;

use Rainbow\Component\Angle;

class AngleTest extends AbstractComponentTest
{
    public function testEmptyShouldReturnZero()
    {
        $angle = $this->createEmptyComponent();

        $this->assertEquals(0, $angle->getValue());
        $this->assertInternalType("int", $angle->getValue());
    }

    protected function createEmptyComponent()
    {
        return new Angle();
    }

    /**
     * @dataProvider getCorrectValueDataProvider
     * @param $value
     * @param $expectedValue
     */
    public function testCorrectValueShouldReturnValue($value, $expectedValue)
    {
        $component = new Angle($value);

        $this->assertEquals($expectedValue, $component->getValue());
        $this->assertInternalType("int", $component->getValue());
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
        $component = new Angle($value);

        $this->assertEquals($expectedValue, $component->getValue());
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
        $component = new Angle($value);

        $this->assertEquals($expectedValue, (string) $component);
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
