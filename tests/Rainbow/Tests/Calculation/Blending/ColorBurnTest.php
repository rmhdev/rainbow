<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Calculation\Blending;

use Rainbow\Calculation\Blending\ColorBurn;
use Rainbow\Rgb;

class ColorBurnTest extends \PHPUnit_Framework_TestCase
{
    public function testSourceColorWhiteShouldReturnWhite()
    {
        $white = new Rgb(255, 255, 255);
        $blending = new ColorBurn($white, new Rgb(100, 150, 200));

        $this->assertEquals($white, $blending->result());
    }

    public function testBackdropColorBlackShouldReturnBlack()
    {
        $black = new Rgb(0, 0, 0);
        $blending = new ColorBurn(new Rgb(100, 150, 200), $black);

        $this->assertEquals($black, $blending->result());
    }

    /**
     * @dataProvider blendingDataProvider
     * @param Rgb $expected
     * @param Rgb $color
     */
    public function testColorShouldReturnCorrectColor(Rgb $expected, Rgb $color)
    {
        $baseColor = new Rgb(255, 102, 0);
        $overlay = new ColorBurn($baseColor, $color);

        $this->assertEquals($expected, $overlay->result());
    }

    public function blendingDataProvider()
    {
        return array(
            array(new Rgb(255, 0, 0), new Rgb(0, 0, 0)),
            array(new Rgb(255, 0, 0), new Rgb(51, 51, 51)),
            array(new Rgb(255, 0, 0), new Rgb(102, 102, 102)),
            array(new Rgb(255, 0, 0), new Rgb(153, 153, 153)),
            array(new Rgb(255, 64, 0), new Rgb(204, 204, 204)),
            array(new Rgb(255, 102, 0), new Rgb(255, 255, 255)),
            array(new Rgb(255, 0, 0), new Rgb(255, 0, 0)),
            array(new Rgb(255, 102, 0), new Rgb(0, 255, 0)),
            array(new Rgb(255, 0, 0), new Rgb(0, 0, 255)),
        );
    }
}
