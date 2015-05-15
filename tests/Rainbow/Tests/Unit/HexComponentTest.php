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

class HexComponentTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyShouldReturnZero()
    {
        $hexComponent = new HexComponent();

        $this->assertEquals("00", $hexComponent->getValue());
    }

    /**
     * @dataProvider correctValueDataProvider
     * @param string $expected
     * @param string $value
     */
    public function testCorrectValueShouldReturnValue($expected, $value)
    {
        $hexComponent = new HexComponent($value);

        $this->assertEquals($expected, $hexComponent->getValue());
    }

    public function correctValueDataProvider()
    {
        return array(
            array("00", "00"),
            array("ff", "FF"),
            array("1a", "1a"),
        );
    }
}
