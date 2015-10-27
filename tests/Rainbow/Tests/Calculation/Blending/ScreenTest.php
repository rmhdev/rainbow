<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Calculation\Blending;

use Rainbow\Calculation\Blending\Screen;
use Rainbow\Rgba;

class ScreenTest extends \PHPUnit_Framework_TestCase
{
    public function testScreenWithBlackShouldReturnColor()
    {
        $color = new Rgba(255, 102, 0, 1);
        $black = new Rgba(0, 0, 0, 1);
        $operation = new Screen($color, $black);

        $this->assertEquals($color, $operation->result());
    }

    public function testScreenWithWhiteShouldReturnWhite()
    {
        $color = new Rgba(255, 102, 0, 1);
        $white = new Rgba(255, 255, 255, 1);
        $operation = new Screen($color, $white);

        $this->assertEquals($white, $operation->result());
    }

    /**
     * @dataProvider screenDataProvider
     * @param Rgba $expected
     * @param Rgba $color1
     * @param Rgba $color2
     */
    public function testScreenColorShouldReturnExpectedColor(Rgba $expected, Rgba $color1, Rgba $color2)
    {
        $operation = new Screen($color1, $color2);

        $this->assertEquals($expected, $operation->result());
    }

    public function screenDataProvider()
    {
        return array(
            array(new Rgba(255, 133, 51, 1), new Rgba(255, 102, 0, 1), new Rgba(51, 51, 51, 1)),
            array(new Rgba(255, 163, 102, 1), new Rgba(255, 102, 0, 1), new Rgba(102, 102, 102, 1)),
            array(new Rgba(255, 194, 153, 1), new Rgba(255, 102, 0, 1), new Rgba(153, 153, 153, 1)),
            array(new Rgba(255, 224, 204, 1), new Rgba(255, 102, 0, 1), new Rgba(204, 204, 204, 1)),
            array(new Rgba(255, 102, 0, 1), new Rgba(255, 102, 0, 1), new Rgba(255, 0, 0, 1)),
            array(new Rgba(255, 255, 0, 1), new Rgba(255, 102, 0, 1), new Rgba(0, 255, 0, 1)),
            array(new Rgba(255, 102, 255, 1), new Rgba(255, 102, 0, 1), new Rgba(0, 0, 255, 1)),
        );
    }
}
