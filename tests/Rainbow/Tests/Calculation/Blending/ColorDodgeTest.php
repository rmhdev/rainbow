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
use Rainbow\Rgb;

class ColorDodgeTest extends \PHPUnit_Framework_TestCase
{
    public function testBaseBlackShouldReturnBlack()
    {
        $black = new Rgb(0, 0, 0);
        $blend = new ColorDodge($black, new Rgb(100, 150, 200));

        $this->assertEquals($black, $blend->result());
    }

    public function testWithWhiteShouldReturnWhite()
    {
        $white = new Rgb(255, 255, 255);
        $blend = new ColorDodge(new Rgb(100, 150, 200), $white);

        $this->assertEquals($white, $blend->result());
    }

    /**
     * @dataProvider blendingDataProvider
     * @param Rgb $expected
     * @param Rgb $color
     */
    public function testColorShouldReturnCorrectColor(Rgb $expected, Rgb $color)
    {
        $baseColor = new Rgb(255, 102, 0);
        $overlay = new ColorDodge($baseColor, $color);

        $this->assertEquals($expected, $overlay->result());
    }

    public function blendingDataProvider()
    {
        return array(
            array(new Rgb(255, 102, 0), new Rgb(0, 0, 0)),
            array(new Rgb(255, 128, 0), new Rgb(51, 51, 51)),
            array(new Rgb(255, 170, 0), new Rgb(102, 102, 102)),
            array(new Rgb(255, 255, 0), new Rgb(153, 153, 153)),
            array(new Rgb(255, 255, 0), new Rgb(204, 204, 204)),
            array(new Rgb(255, 255, 0), new Rgb(255, 255, 255)),
            array(new Rgb(255, 102, 0), new Rgb(255, 0, 0)),
            array(new Rgb(255, 255, 0), new Rgb(0, 255, 0)),
            array(new Rgb(255, 102, 0), new Rgb(0, 0, 255)),
        );
    }
}
