<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Compositing\Blending;

use Rainbow\Compositing\Blending\Overlay;
use Rainbow\Rgba;

class OverlayTest extends \PHPUnit_Framework_TestCase
{
    public function testWhiteWithBlackShouldReturnWhite()
    {
        $white = new Rgba(255, 255, 255, 1);
        $black = new Rgba(0, 0, 0, 1);
        $operation = new Overlay($white, $black);

        $this->assertEquals($white, $operation->result());
    }

    public function testBlackWithWhiteShouldReturnBlack()
    {
        $white = new Rgba(255, 255, 255, 1);
        $black = new Rgba(0, 0, 0, 1);
        $operation = new Overlay($black, $white);

        $this->assertEquals($black, $operation->result());
    }

    /**
     * @dataProvider overlayDataProvider
     * @param Rgba $expected
     * @param Rgba $color
     */
    public function testColorShouldReturnCorrectColor(Rgba $expected, Rgba $color)
    {
        $lowLumaColor = new Rgba(255, 102, 0, 1);
        $overlay = new Overlay($lowLumaColor, $color);

        $this->assertEquals($expected, $overlay->result());
    }

    public function overlayDataProvider()
    {
        return array(
            array(new Rgba(255, 0, 0, 1), new Rgba(0, 0, 0, 1)),
            array(new Rgba(255, 41, 0, 1), new Rgba(51, 51, 51, 1)),
            array(new Rgba(255, 82, 0, 1), new Rgba(102, 102, 102, 1)),
            array(new Rgba(255, 122, 0, 1), new Rgba(153, 153, 153, 1)),
            array(new Rgba(255, 163, 0, 1), new Rgba(204, 204, 204, 1)),
            array(new Rgba(255, 204, 0, 1), new Rgba(255, 255, 255, 1)),
            array(new Rgba(255, 0, 0, 1), new Rgba(255, 0, 0, 1)),
            array(new Rgba(255, 204, 0, 1), new Rgba(0, 255, 0, 1)),
            array(new Rgba(255, 0, 0, 1), new Rgba(0, 0, 255, 1)),
            array(new Rgba(255, 102, 0, 1), new Rgba(128, 128, 128, 1)),
            array(new Rgba(255, 102, 0, 1), new Rgba(127, 127, 127, 1)),
            array(new Rgba(255, 103, 0, 1), new Rgba(129, 129, 129, 1)),
        );
    }
}
