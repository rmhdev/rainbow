<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Calculation\Blending;

use Rainbow\Calculation\Blending\HardLight;
use Rainbow\Rgba;

class HardLightTest extends \PHPUnit_Framework_TestCase
{
    public function testWhiteWithBlackShouldReturnBlack()
    {
        $white = new Rgba(255, 255, 255, 1);
        $black = new Rgba(0, 0, 0, 1);
        $operation = new HardLight($white, $black);

        $this->assertEquals($black, $operation->result());
    }

    public function testBlackWithWhiteShouldReturnWhite()
    {
        $white = new Rgba(255, 255, 255, 1);
        $black = new Rgba(0, 0, 0, 1);
        $operation = new HardLight($black, $white);

        $this->assertEquals($white, $operation->result());
    }

    /**
     * @dataProvider colorDataProvider
     * @param Rgba $expected
     * @param Rgba $color
     */
    public function testColorShouldReturnCorrectColor(Rgba $expected, Rgba $color)
    {
        $baseColor = new Rgba(255, 102, 0, 1);
        $overlay = new HardLight($baseColor, $color);

        $this->assertEquals($expected, $overlay->result());
    }

    public function colorDataProvider()
    {
        return array(
            array(new Rgba(0, 0, 0, 1), new Rgba(0, 0, 0, 1)),
            array(new Rgba(102, 41, 0, 1), new Rgba(51, 51, 51, 1)),
            array(new Rgba(204, 82, 0, 1), new Rgba(102, 102, 102, 1)),
            array(new Rgba(255, 133, 51, 1), new Rgba(153, 153, 153, 1)),
            array(new Rgba(255, 194, 153, 1), new Rgba(204, 204, 204, 1)),
            array(new Rgba(255, 255, 255, 1), new Rgba(255, 255, 255, 1)),
            array(new Rgba(255, 0, 0, 1), new Rgba(255, 0, 0, 1)),
            array(new Rgba(0, 255, 0, 1), new Rgba(0, 255, 0, 1)),
            array(new Rgba(0, 0, 255, 1), new Rgba(0, 0, 255, 1)),
        );
    }
}
