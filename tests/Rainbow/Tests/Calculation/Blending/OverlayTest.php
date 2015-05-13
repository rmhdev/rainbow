<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Calculation\Blending;

use Rainbow\Calculation\Blending\Overlay;
use Rainbow\Rgb;

class OverlayTest extends \PHPUnit_Framework_TestCase
{
    public function testWhiteWithBlackShouldReturnWhite()
    {
        $white = new Rgb(255, 255, 255);
        $black = new Rgb(0, 0, 0);
        $operation = new Overlay($white, $black);

        $this->assertEquals($white, $operation->result());
    }

    public function testBlackWithWhiteShouldReturnBlack()
    {
        $white = new Rgb(255, 255, 255);
        $black = new Rgb(0, 0, 0);
        $operation = new Overlay($black, $white);

        $this->assertEquals($black, $operation->result());
    }

    /**
     * @dataProvider lowLumaDataProvider
     * @param Rgb $expected
     * @param Rgb $color
     */
    public function testColorShouldReturnCorrectColor(Rgb $expected, Rgb $color)
    {
        $lowLumaColor = new Rgb(255, 102, 0);
        $overlay = new Overlay($lowLumaColor, $color);

        $this->assertEquals($expected, $overlay->result());
    }

    public function lowLumaDataProvider()
    {
        return array(
            array(new Rgb(255, 0, 0), new Rgb(0, 0, 0)),
            array(new Rgb(255, 41, 0), new Rgb(51, 51, 51)),
            array(new Rgb(255, 82, 0), new Rgb(102, 102, 102)),
            array(new Rgb(255, 122, 0), new Rgb(153, 153, 153)),
            array(new Rgb(255, 163, 0), new Rgb(204, 204, 204)),
            array(new Rgb(255, 204, 0), new Rgb(255, 255, 255)),
            array(new Rgb(255, 0, 0), new Rgb(255, 0, 0)),
            array(new Rgb(255, 0, 0), new Rgb(0, 0, 255)),
        );
    }
}
