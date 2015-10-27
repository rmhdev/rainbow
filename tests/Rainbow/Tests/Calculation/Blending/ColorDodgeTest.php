<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Calculation\Blending;

use Rainbow\Calculation\Blending\ColorDodge;
use Rainbow\Rgba;

class ColorDodgeTest extends \PHPUnit_Framework_TestCase
{
    public function testBaseBlackShouldReturnBlack()
    {
        $black = new Rgba(0, 0, 0);
        $blend = new ColorDodge($black, new Rgba(100, 150, 200));

        $this->assertEquals($black, $blend->result());
    }

    public function testWithWhiteShouldReturnWhite()
    {
        $white = new Rgba(255, 255, 255);
        $blend = new ColorDodge(new Rgba(100, 150, 200), $white);

        $this->assertEquals($white, $blend->result());
    }

    /**
     * @dataProvider blendingDataProvider
     * @param Rgba $expected
     * @param Rgba $color
     */
    public function testColorShouldReturnCorrectColor(Rgba $expected, Rgba $color)
    {
        $baseColor = new Rgba(255, 102, 0);
        $overlay = new ColorDodge($baseColor, $color);

        $this->assertEquals($expected, $overlay->result());
    }

    public function blendingDataProvider()
    {
        return array(
            array(new Rgba(255, 102, 0, 1), new Rgba(0, 0, 0, 1)),
            array(new Rgba(255, 128, 0, 1), new Rgba(51, 51, 51, 1)),
            array(new Rgba(255, 170, 0, 1), new Rgba(102, 102, 102, 1)),
            array(new Rgba(255, 255, 0, 1), new Rgba(153, 153, 153, 1)),
            array(new Rgba(255, 255, 0, 1), new Rgba(204, 204, 204, 1)),
            array(new Rgba(255, 255, 0, 1), new Rgba(255, 255, 255, 1)),
            array(new Rgba(255, 102, 0, 1), new Rgba(255, 0, 0, 1)),
            array(new Rgba(255, 255, 0, 1), new Rgba(0, 255, 0, 1)),
            array(new Rgba(255, 102, 0, 1), new Rgba(0, 0, 255, 1)),
        );
    }
}
