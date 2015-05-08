<?php

namespace Rainbow\Tests\Calculation\Operation;

use Rainbow\Calculation\Operation\Contrast;
use Rainbow\Rgb;

class ContrastTest extends \PHPUnit_Framework_TestCase
{
    public function testWhiteReturnsBlackByDefault()
    {
        $rgb = new Rgb(255, 255, 255);
        $expectedRgb = new Rgb(0, 0, 0);
        $operation = new Contrast($rgb);

        $this->assertEquals($expectedRgb, $operation->result()->translate()->toRgb());
    }

    public function testBlackReturnsWhiteByDefault()
    {
        $rgb = new Rgb(0, 0, 0);
        $expectedRgb = new Rgb(255, 255, 255);
        $operation = new Contrast($rgb);

        $this->assertEquals($expectedRgb, $operation->result()->translate()->toRgb());
    }

    public function testWhiteReturnsDarkColor()
    {
        $rgb = new Rgb(255, 255, 255);
        $dark = new Rgb(50, 50, 50);
        $operation = new Contrast($rgb, $dark);

        $this->assertEquals($dark, $operation->result()->translate()->toRgb());
    }

    public function testBlackReturnsLightColor()
    {
        $rgb = new Rgb(0, 0, 0);
        $light = new Rgb(200, 200, 200);
        $operation = new Contrast($rgb, null, $light);

        $this->assertEquals($light, $operation->result()->translate()->toRgb());
    }
}
