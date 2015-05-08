<?php

namespace Rainbow\Tests\Calculation\Operation;

use Rainbow\Calculation\Operation\Spin;
use Rainbow\Hsl;
use Rainbow\Unit\Angle;

class SpinTest extends \PHPUnit_Framework_TestCase
{
    public function testSpinShouldReturnNewAngle()
    {
        $color = new Hsl(180, 50, 50);
        $operation = new Spin($color, 10);

        $this->assertEquals(new Angle(190), $operation->result());
    }
}
