<?php

namespace Rainbow\Tests\Calculation\Channel;

use Rainbow\Calculation\Channel\Luminance;
use Rainbow\Rgb;
use Rainbow\Unit\Percent;

class LuminanceTest extends \PHPUnit_Framework_TestCase
{
    public function testBlackShouldReturnMinValue()
    {
        $color = new Rgb(0, 0, 0);
        $operation = new Luminance($color);

        $this->assertEquals(new Percent(0), $operation->result());
    }

    public function testWhiteShouldReturnMinValue()
    {
        $color = new Rgb(255, 255, 255);
        $operation = new Luminance($color);

        $this->assertEquals(new Percent(100), $operation->result());
    }
}
