<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Calculation\Blending;

use Rainbow\Calculation\Blending\Multiply;
use Rainbow\Rgb;

class MultiplyTest extends \PHPUnit_Framework_TestCase
{
    public function testWithBlackShouldReturnBlack()
    {
        $color = new Rgb(255, 102, 0);
        $black = new Rgb();
        $operation = new Multiply($color, $black);

        $this->assertEquals($black, $operation->result());
    }

    public function testWithWhiteShouldReturnColor()
    {
        $color = new Rgb(255, 102, 0);
        $white = new Rgb(255, 255, 255);
        $operation = new Multiply($color, $white);

        $this->assertEquals($color, $operation->result());
    }

    /**
     * @dataProvider multiplyDataProvider
     * @param Rgb $expected
     * @param Rgb $colorA
     * @param Rgb $colorB
     */
    public function testMultiplyColorsShouldReturnCorrectColor(Rgb $expected, Rgb $colorA, Rgb $colorB)
    {
        $operation = new Multiply($colorA, $colorB);

        $this->assertEquals($expected, $operation->result());
    }

    public function multiplyDataProvider()
    {
        return array(
            array(new Rgb(100, 0, 0), new Rgb(255, 0, 0), new Rgb(100, 0, 0)),
            array(new Rgb(100, 100, 0), new Rgb(255, 255, 0), new Rgb(100, 100, 0)),
            array(new Rgb(100, 100, 100), new Rgb(255, 255, 255), new Rgb(100, 100, 100)),
            array(new Rgb(39, 39, 39), new Rgb(100, 100, 100), new Rgb(100, 100, 100)),
        );
    }
}
