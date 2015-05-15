<?php

namespace Rainbow\Tests\Converter;

use Rainbow\Converter\RgbToHexConverter;
use Rainbow\Hex;
use Rainbow\Rgb;

class RgbToHexConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider colorDataProvider
     * @param $expected
     * @param $color
     */
    public function testConvertShouldReturnSameColor($expected, $color)
    {
        $converter = new RgbToHexConverter($color);

        $this->assertEquals($expected, $converter->convert());
    }

    public function colorDataProvider()
    {
        return array(
            array(new Hex("#000000"), new Rgb(0, 0, 0)),
            array(new Hex("#ff0000"), new Rgb(255, 0, 0)),
            array(new Hex("#00ff00"), new Rgb(0, 255, 0)),
            array(new Hex("#0000ff"), new Rgb(0, 0, 255)),
            array(new Hex("#3296fa"), new Rgb(50, 150, 250)),
        );
    }
}
