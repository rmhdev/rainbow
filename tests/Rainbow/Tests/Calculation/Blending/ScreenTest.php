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
}
