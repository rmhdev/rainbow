<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Component;

use Rainbow\Component\Rgb;

class RgbTest extends AbstractComponentTest
{
    public function testEmptyShouldReturnZero()
    {
        $component = $this->createEmptyComponent();

        $this->assertEquals(0, $component->getValue());
    }

    protected function createEmptyComponent()
    {
        return new Rgb();
    }

    protected function expectedMaxValue()
    {
        return 255;
    }

    /**
     * @dataProvider getCorrectValueDataProvider
     * @param $expectedValue
     * @param $value
     */
    public function testCorrectValueShouldReturnValue($expectedValue, $value)
    {
        $component = new Rgb($value);

        $this->assertEquals($expectedValue, $component->getValue());
    }

    public function getCorrectValueDataProvider()
    {
        return array(
            array(30, 30),
            array(127, 127.1),
            array(127, 127.4),
            array(128, 127.5),
            array(128, 127.6),
            array(128, 127.9),
        );
    }

    /**
     * @dataProvider getCorrectStringValueDataProvider
     * @param $expectedValue
     * @param $value
     */
    public function testCorrectStringShouldReturnValue($expectedValue, $value)
    {
        $component = new Rgb($value);

        $this->assertEquals($expectedValue, $component->getValue());
        $this->assertInternalType("int", $component->getValue());
    }

    public function getCorrectStringValueDataProvider()
    {
        return array(
            array(12, "12"),
            array(12, " 12 "),
            array(12, "\n12\t"),
        );
    }

    /**
     * @dataProvider getOutOfBoundsDataProvider
     * @expectedException \OutOfBoundsException
     * @param $value
     */
    public function testOutOfBoundsValueShouldThrowException($value)
    {
        new Rgb($value);
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
     * @param $value
     */
    public function testUnexpectedValueShouldThrowException($value)
    {
        new Rgb($value);
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
     * @param $expectedValue
     * @param $value
     */
    public function testToStringShouldReturnStringValue($expectedValue, $value)
    {
        $component = new Rgb($value);

        $this->assertEquals($expectedValue, (string) $component);
    }

    public function getToStringDataProvider()
    {
        return array(
            array("0", 0),
            array("12", 12),
            array("12", " 12 "),
        );
    }

    /**
     * @dataProvider getPercentValueDataProvider
     * @param $expectedValue
     * @param $value
     */
    public function testPercentValuesShouldBeTransformed($expectedValue, $value)
    {
        $component = new Rgb($value);

        $this->assertEquals($expectedValue, $component->getValue());
    }

    public function getPercentValueDataProvider()
    {
        return array(
            array(255, "100%"),
            array(0, "0%"),
            array(128, "50%"),
            array(191, "75%"),
            array(64, "25%"),
        );
    }
}
