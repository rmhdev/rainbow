<?php

namespace Rainbow\Tests\Component;

use Rainbow\Component\Component;

class ComponentTest extends AbstractComponentTest
{
    public function testEmptyShouldReturnZero()
    {
        $component = $this->createEmptyComponent();

        $this->assertEquals(1, $component->getValue());
        $this->assertInternalType("float", $component->getValue());
    }

    protected function createEmptyComponent()
    {
        return new Component();
    }

    protected function expectedMaxValue()
    {
        return 1;
    }

    /**
     * @dataProvider getCorrectValueDataProvider
     * @param $value
     * @param $expectedValue
     */
    public function testCorrectValueShouldReturnValue($value, $expectedValue)
    {
        $component = new Component($value);

        $this->assertEquals($expectedValue, $component->getValue());
        $this->assertInternalType("float", $component->getValue());
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
            array(0.401, 0.40),
            array(0.404, 0.40),
            array(0.405, 0.41),
            array(0.409, 0.41),
        );
    }

    /**
     * @dataProvider getOutOfBoundsDataProvider
     * @expectedException \OutOfBoundsException
     * @param $value
     */
    public function testOutOfBoundsValueShouldThrowException($value)
    {
        new Component($value);
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
        new Component($value);
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
        $component = new Component($value);

        $this->assertEquals($expectedValue, (string) $component);
    }

    public function getToStringDataProvider()
    {
        return array(
            array(0, "0"),
            array(" 1 ", "1"),
            array(0.1, "0.1"),
            array(0.12345, "0.12"),
        );
    }
}
