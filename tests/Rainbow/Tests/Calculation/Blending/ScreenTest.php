<?php

namespace Rainbow\Tests\Calculation\Blending;

use Rainbow\Calculation\Blending\Screen;
use Rainbow\Rgb;

class ScreenTest extends \PHPUnit_Framework_TestCase
{
    public function testScreenWithBlackShouldReturnColor()
    {
        $color = new Rgb(255, 102, 0);
        $black = new Rgb(0, 0, 0);
        $operation = new Screen($color, $black);

        $this->assertEquals($color, $operation->result());
    }
}
