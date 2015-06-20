<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Converter;

use Rainbow\Converter\RgbaConverter;
use Rainbow\Rgba;

class RgbaConverterTest extends \PHPUnit_Framework_TestCase
{
    public function testGetColorShouldReturnRgba()
    {
        $color = new Rgba(100, 150, 200, 0.5);
        $converter = new RgbaConverter($color);

        $this->assertEquals($color, $converter->getColor());
    }
}
