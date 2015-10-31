<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Unit;

use Rainbow\Unit\HexComponent;

class HexComponentTest extends AbstractUnitTest
{
    public function testEmptyShouldReturnZero()
    {
        $hexComponent = $this->createEmptyUnit();

        $this->assertEquals(0, $hexComponent->getValue());
    }

    protected function createEmptyUnit()
    {
        return new HexComponent();
    }

    protected function expectedMaxValue()
    {
        return 255;
    }

    /**
     * @dataProvider correctValueDataProvider
     * @param string $expected
     * @param string|number $value
     */
    public function testCorrectValueShouldReturnValue($expected, $value)
    {
        $hexComponent = new HexComponent($value);

        $this->assertEquals($expected, (string)$hexComponent);
    }

    public function correctValueDataProvider()
    {
        return array(
            array("00", "00"),
            array("ff", "FF"),
            array("1a", "1a"),
            array("00", "0"),
            array("ff", "0xFF"),
        );
    }

    /**
     * @dataProvider incorrectValueDataProvider
     * @param $value
     * @expectedException \OutOfBoundsException
     */
    public function testOutOfBoundsValueShouldThrowException($value)
    {
        new HexComponent($value);
    }

    public function incorrectValueDataProvider()
    {
        return array(
            array("123"),
            array("-1"),
        );
    }

    public function testToStringShouldReturnStringRepresentationOfValue()
    {
        $hexComponent = new HexComponent("1a");

        $this->assertEquals("1a", (string)$hexComponent);
    }
}
