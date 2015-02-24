<?php

namespace Rainbow\Tests;

use Rainbow\Hsl;
use Rainbow\Unit\Percent;

class HslTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyColorShouldReturnBlack()
    {
        $color = new Hsl();

        $this->assertEquals(0, $color->getHue());
        $this->assertEquals(new Percent(0), $color->getSaturation());
        $this->assertEquals(new Percent(0), $color->getLightness());
    }

    public function testColorShouldReturnDefinedValues()
    {
        $color = new Hsl(20, 30, 40);

        $this->assertEquals(20, $color->getHue());
        $this->assertEquals(new Percent(30), $color->getSaturation());
        $this->assertEquals(new Percent(40), $color->getLightness());
    }
}
