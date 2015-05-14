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
use Rainbow\Rgb;

class HardLightTest extends \PHPUnit_Framework_TestCase
{
    public function testWhiteWithBlackShouldReturnBlack()
    {
        $white = new Rgb(255, 255, 255);
        $black = new Rgb(0, 0, 0);
        $operation = new HardLight($white, $black);

        $this->assertEquals($black, $operation->result());
    }

    public function testBlackWithWhiteShouldReturnWhite()
    {
        $white = new Rgb(255, 255, 255);
        $black = new Rgb(0, 0, 0);
        $operation = new HardLight($black, $white);

        $this->assertEquals($white, $operation->result());
    }

    /**
     * @dataProvider colorDataProvider
     * @param Rgb $expected
     * @param Rgb $color
     */
    public function testColorShouldReturnCorrectColor(Rgb $expected, Rgb $color)
    {
        $baseColor = new Rgb(255, 102, 0);
        $overlay = new HardLight($baseColor, $color);

        $this->assertEquals($expected, $overlay->result());
    }

    public function colorDataProvider()
    {
        return array(
            array(new Rgb(0, 0, 0), new Rgb(0, 0, 0)),
            array(new Rgb(102, 41, 0), new Rgb(51, 51, 51)),
            array(new Rgb(204, 82, 0), new Rgb(102, 102, 102)),
            array(new Rgb(255, 133, 51), new Rgb(153, 153, 153)),
            array(new Rgb(255, 194, 153), new Rgb(204, 204, 204)),
            array(new Rgb(255, 255, 255), new Rgb(255, 255, 255)),
            array(new Rgb(255, 0, 0), new Rgb(255, 0, 0)),
            array(new Rgb(0, 255, 0), new Rgb(0, 255, 0)),
            array(new Rgb(0, 0, 255), new Rgb(0, 0, 255)),
        );
    }
}
