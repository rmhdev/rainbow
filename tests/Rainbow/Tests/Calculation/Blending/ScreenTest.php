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
use Rainbow\Rgb;

class ScreenTest extends \PHPUnit_Framework_TestCase
{
    public function testScreenWithBlackShouldReturnColor()
    {
        $color = new Rgb(255, 102, 0);
        $black = new Rgb(0, 0, 0);
        $operation = new Screen($color, $black);

        $this->assertEquals($color, $operation->result());
    }

    public function testScreenWithWhiteShouldReturnWhite()
    {
        $color = new Rgb(255, 102, 0);
        $white = new Rgb(255, 255, 255);
        $operation = new Screen($color, $white);

        $this->assertEquals($white, $operation->result());
    }

    /**
     * @dataProvider screenDataProvider
     * @param Rgb $expected
     * @param Rgb $color1
     * @param Rgb $color2
     */
    public function testScreenColorShouldReturnExpectedColor(Rgb $expected, Rgb $color1, Rgb $color2)
    {
        $operation = new Screen($color1, $color2);

        $this->assertEquals($expected, $operation->result());
    }

    public function screenDataProvider()
    {
        return array(
            array(new Rgb(255, 133, 51), new Rgb(255, 102, 0), new Rgb(51, 51, 51)),
            array(new Rgb(255, 163, 102), new Rgb(255, 102, 0), new Rgb(102, 102, 102)),
            array(new Rgb(255, 194, 153), new Rgb(255, 102, 0), new Rgb(153, 153, 153)),
            array(new Rgb(255, 224, 204), new Rgb(255, 102, 0), new Rgb(204, 204, 204)),
            array(new Rgb(255, 102, 0), new Rgb(255, 102, 0), new Rgb(255, 0, 0)),
            array(new Rgb(255, 255, 0), new Rgb(255, 102, 0), new Rgb(0, 255, 0)),
            array(new Rgb(255, 102, 255), new Rgb(255, 102, 0), new Rgb(0, 0, 255)),
        );
    }
}
