<?php

namespace Rainbow\Tests;

use Rainbow\Hex;

class HexTest extends \PHPUnit_Framework_TestCase
{
    public function testGetNameShouldReturnConstName()
    {
        $color = new Hex();

        $this->assertEquals("hex", $color->getName());
    }

    public function testDefaultColorShouldBeBlack()
    {
        $color = new Hex();

        $this->assertEquals("#000000", (string)$color);
    }

    /**
     * @dataProvider correctInputDataProvider
     * @param $expected
     * @param $text
     */
    public function testCorrectInputShouldCreateColor($expected, $text)
    {
        $color = new Hex($text);

        $this->assertEquals($expected, (string)$color);
    }

    public function correctInputDataProvider()
    {
        return array(
            array("#123456", "123456"),
            array("#000000", " "),
            array("#123456", " 12 34 56"),
            array("#123abc", "123ABC"),
            array("#aabbcc", "abc"),
        );
    }
}
