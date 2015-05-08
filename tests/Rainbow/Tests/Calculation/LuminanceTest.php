<?php

namespace Rainbow\Tests\Calculation;

use Rainbow\Calculation\Luminance;
use Rainbow\Hsl;
use Rainbow\Unit\Percent;

class LuminanceTest extends \PHPUnit_Framework_TestCase
{
    public function testLuminanceInBlackShouldReturnMinValue()
    {
        $color = new Hsl(0, 0, 0);
        $luminance = new Luminance($color);

        $this->assertEquals(new Percent(0), $luminance->value());
    }

    public function testLuminanceInWhiteShouldReturnMaxValue()
    {
        $color = new Hsl(360, 100, 100);
        $luminance = new Luminance($color);

        $this->assertEquals(new Percent(100), $luminance->value());
    }
}
