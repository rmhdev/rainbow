<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Converter;

use Rainbow\Converter\RgbConverter;
use Rainbow\Rgb;

class RgbConverterTest extends \PHPUnit_Framework_TestCase
{
    public function testToRgbShouldReturnRgb()
    {
        $color = new Rgb(100, 150, 200);

        $this->assertEquals($color, RgbConverter::ToRgb($color));
    }

    public function testFromRgbShouldReturnRgb()
    {
        $color = new Rgb(100, 150, 200);

        $this->assertEquals($color, RgbConverter::fromRgb($color));
    }
}
