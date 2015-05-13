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
    public function testLowLumaColorShouldReturnMultiplyColor(Rgb $expected, Rgb $color)
    {
        $lowLumaColor = new Rgb(255, 102, 0);
        $overlay = new Overlay($lowLumaColor, $color);

        $this->assertEquals($expected, $overlay->result());
    }

    public function lowLumaDataProvider()
    {
        return array(
            array(new Rgb(255, 0, 0), new Rgb(0, 0, 0)),
        );
    }
}