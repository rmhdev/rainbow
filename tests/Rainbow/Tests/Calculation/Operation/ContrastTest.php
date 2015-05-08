<?php

namespace Rainbow\Tests\Calculation\Operation;

use Rainbow\Calculation\Operation\Contrast;
use Rainbow\Rgb;

class ContrastTest extends \PHPUnit_Framework_TestCase
{
    public function testLightColorReturnsBlackColorByDefault()
    {
        $rgb = new Rgb(255, 255, 255);
        $expectedRgb = new Rgb(0, 0, 0);
        $operation = new Contrast($rgb);

        $this->assertEquals($expectedRgb, $operation->result()->translate()->toRgb());
    }

    public function testDarkColorReturnsWhiteColorByDefault()
    {
        $rgb = new Rgb(0, 0, 0);
        $expectedRgb = new Rgb(255, 255, 255);
        $operation = new Contrast($rgb);

        $this->assertEquals($expectedRgb, $operation->result()->translate()->toRgb());
    }
}
