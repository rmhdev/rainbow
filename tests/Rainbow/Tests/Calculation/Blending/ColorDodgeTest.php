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
}
