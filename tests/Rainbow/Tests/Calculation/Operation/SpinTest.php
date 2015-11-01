<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Calculation\Operation;

use Rainbow\Calculation\Operation\Spin;
use Rainbow\Hsl;
use Rainbow\Component\Angle;

class SpinTest extends \PHPUnit_Framework_TestCase
{
    public function testSpinShouldReturnNewAngle()
    {
        $color = new Hsl(180, 50, 50);
        $operation = new Spin($color, 10);

        $this->assertEquals(new Angle(190), $operation->result());
    }

    public function testEmptySpinShouldReturnEqualAngle()
    {
        $color = new Hsl(180, 50, 50);
        $operation = new Spin($color);

        $this->assertEquals(new Angle(180), $operation->result());
    }
}
