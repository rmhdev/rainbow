<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Compositing\Blending;

use Rainbow\Compositing\Blending\ColorBurn;
use Rainbow\Rgba;

class ColorBurnTest extends \PHPUnit_Framework_TestCase
{
    public function testSourceColorWhiteShouldReturnWhite()
    {
        $white = new Rgba(255, 255, 255, 1);
        $blending = new ColorBurn($white, new Rgba(100, 150, 200, 1));

        $this->assertEquals($white, $blending->result());
    }

    public function testBackdropColorBlackShouldReturnBlack()
    {
        $black = new Rgba(0, 0, 0, 1);
        $blending = new ColorBurn(new Rgba(100, 150, 200, 1), $black);

        $this->assertEquals($black, $blending->result());
    }

    /**
     * @dataProvider blendingDataProvider
     * @param Rgba $expected
     * @param Rgba $color
     */
    public function testColorShouldReturnCorrectColor(Rgba $expected, Rgba $color)
    {
        $baseColor = new Rgba(255, 102, 0, 1);
        $overlay = new ColorBurn($baseColor, $color);

        $this->assertEquals($expected, $overlay->result());
    }

    public function blendingDataProvider()
    {
        return array(
            array(new Rgba(255, 0, 0, 1), new Rgba(0, 0, 0, 1)),
            array(new Rgba(255, 0, 0, 1), new Rgba(51, 51, 51, 1)),
            array(new Rgba(255, 0, 0, 1), new Rgba(102, 102, 102, 1)),
            array(new Rgba(255, 0, 0, 1), new Rgba(153, 153, 153, 1)),
            array(new Rgba(255, 64, 0, 1), new Rgba(204, 204, 204, 1)),
            array(new Rgba(255, 102, 0, 1), new Rgba(255, 255, 255, 1)),
            array(new Rgba(255, 0, 0, 1), new Rgba(255, 0, 0, 1)),
            array(new Rgba(255, 102, 0, 1), new Rgba(0, 255, 0, 1)),
            array(new Rgba(255, 0, 0, 1), new Rgba(0, 0, 255, 1)),
        );
    }

    public function testAlphaColorBurnWithTotalOpaqueBackdropShouldReturnTotalOpacity()
    {
        $backdrop = new Rgba(100, 100, 100, 1);
        $source = new Rgba(150, 150, 150, 0);
        $blend = new ColorBurn($backdrop, $source);

        $this->assertEquals(1, $blend->result()->getAlpha()->getValue());
    }

    public function testAlphaColorBurnWithTransparentBackdropShouldReturnTransparentAlpha()
    {
        $backdrop = new Rgba(100, 100, 100, 0.5);
        $source = new Rgba(150, 150, 150, 0);
        $blend = new ColorBurn($backdrop, $source);

        $this->assertEquals(0, $blend->result()->getAlpha()->getValue());
    }

    public function testAlphaColorBurnShouldReturnCorrectAlpha()
    {
        $backdrop = new Rgba(100, 100, 100, 0.5);
        $source = new Rgba(150, 150, 150, 0.7);
        $blend = new ColorBurn($backdrop, $source);

        $this->assertEquals(0.29, $blend->result()->getAlpha()->getValue());
    }
}
