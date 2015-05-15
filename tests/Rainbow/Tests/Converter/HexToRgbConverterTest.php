<?php

namespace Rainbow\Tests\Converter;

use Rainbow\Converter\HexToRgbConverter;
use Rainbow\Hex;
use Rainbow\Rgb;

class HexToRgbConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider colorDataProvider
     * @param $expected
     * @param $color
     */
    public function testConvertShouldReturnSameColor($expected, $color)
    {
        $converter = new HexToRgbConverter($color);

        $this->assertEquals($expected, $converter->convert());
    }

    public function colorDataProvider()
    {
        return array(
            array(new Rgb(0, 0, 0), new Hex("#000000")),
        );
    }
}
