<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests;

use Rainbow\Rgb;
use Rainbow\Unit\Dimension;

class RgbTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptyColorShouldReturnZeros()
    {
        $color = new Rgb();

        $empty = new Dimension();
        $this->assertEquals($empty, $color->getRed());
        $this->assertEquals($empty, $color->getGreen());
        $this->assertEquals($empty, $color->getBlue());
    }

    public function testColorShouldReturnDefinedValues()
    {
        $color = new Rgb(50, 100, 150);

        $this->assertEquals(new Dimension(50), $color->getRed());
        $this->assertEquals(new Dimension(100), $color->getGreen());
        $this->assertEquals(new Dimension(150), $color->getBlue());
    }

}
