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
use Rainbow\Rgba;

class MultiplyTest extends \PHPUnit_Framework_TestCase
{
    public function testWithBlackShouldReturnBlack()
    {
        $color = new Rgba(255, 102, 0, 1);
        $black = new Rgba(0, 0, 0, 1);
        $operation = new Multiply($color, $black);

        $this->assertEquals($black, $operation->result());
    }

    public function testWithWhiteShouldReturnColor()
    {
        $color = new Rgba(255, 102, 0, 1);
        $white = new Rgba(255, 255, 255, 1);
        $operation = new Multiply($color, $white);

        $this->assertEquals($color, $operation->result());
    }

    /**
     * @dataProvider multiplyDataProvider
     * @param Rgba $expected
     * @param Rgba $colorA
     * @param Rgba $colorB
     */
    public function testMultiplyColorsShouldReturnCorrectColor(Rgba $expected, Rgba $colorA, Rgba $colorB)
    {
        $operation = new Multiply($colorA, $colorB);

        $this->assertEquals($expected, $operation->result());
    }

    public function multiplyDataProvider()
    {
        return array(
            array(new Rgba(100, 0, 0, 1), new Rgba(255, 0, 0, 1), new Rgba(100, 0, 0, 1)),
            array(new Rgba(100, 100, 0, 1), new Rgba(255, 255, 0, 1), new Rgba(100, 100, 0, 1)),
            array(new Rgba(100, 100, 100, 1), new Rgba(255, 255, 255, 1), new Rgba(100, 100, 100, 1)),
            array(new Rgba(39, 39, 39, 1), new Rgba(100, 100, 100, 1), new Rgba(100, 100, 100, 1)),
        );
    }
}
