<?php

namespace Rainbow\Tests\Calculation\Blending;

use Rainbow\Calculation\Blending\Difference;
use Rainbow\Rgb;

class DifferenceTest extends \PHPUnit_Framework_TestCase
{
    public function testWithBlackShouldReturnSameColor()
    {
        $baseColor = new Rgb(255, 102, 0);
        $black = new Rgb(0, 0, 0);
        $operation = new Difference($baseColor, $black);

        $this->assertEquals($baseColor, $operation->result());
    }
}
