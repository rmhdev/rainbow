<?php

namespace Rainbow\Tests;

use Rainbow\Hsl;
use Rainbow\Unit\Percent;

class HslTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyColorShouldReturnBlack()
    {
        $color = new Hsl();

        $saturation = new Percent(0);
        $lightness = new Percent(0);
        $this->assertEquals(0, $color->getHue());
        $this->assertEquals($saturation, $color->getSaturation());
        $this->assertEquals($lightness, $color->getLightness());
    }
}
