<?php

namespace Rainbow\Tests\Calculation\Operation;

use Rainbow\Calculation\Operation\Contrast;
use Rainbow\Rgb;

class ContrastTest extends \PHPUnit_Framework_TestCase
{
    public function testLightColorReturnsBlackColor()
    {
        $rgb = new Rgb(255, 255, 255);
        $blackRgb = new Rgb(0, 0, 0);
        $operation = new Contrast($rgb);

        $this->assertEquals($blackRgb, $operation->result()->translate()->toRgb());
    }
}
