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

    public function testColorShouldReturnDefinedValues()
    {
        $color = new Hsl(20, 30, 40);

        $this->assertEquals(20, $color->getHue());
        $this->assertEquals(new Percent(30), $color->getSaturation());
        $this->assertEquals(new Percent(40), $color->getLightness());
    }
}
