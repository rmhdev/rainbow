<?php

namespace Rainbow\Tests\Calculation\Blending;

use Rainbow\Calculation\Blending\Multiply;
use Rainbow\Rgb;

class MultiplyTest extends \PHPUnit_Framework_TestCase
{
    public function testMultiplyBlackShouldReturnBlack()
    {
        $black = new Rgb();
        $operation = new Multiply($black, $black);

        $this->assertEquals($black, $operation->result());
    }
}
