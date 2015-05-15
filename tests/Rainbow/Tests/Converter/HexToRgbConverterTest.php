<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

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
            array(new Rgb(255, 0, 0), new Hex("#ff0000")),
            array(new Rgb(0, 255, 0), new Hex("#00ff00")),
            array(new Rgb(0, 0, 255), new Hex("#0000ff")),
            array(new Rgb(50, 150, 250), new Hex("#3296fa")),
        );
    }
}
