<?php

namespace Rainbow\Tests;

use Rainbow\Rgba;
use Rainbow\Unit\Alpha;
use Rainbow\Unit\RgbComponent;

class RgbaTest extends \PHPUnit_Framework_TestCase
{
    public function testGetNameShouldReturnConstName()
    {
        $rgba = new Rgba();

        $this->assertEquals("rgba", $rgba->getName());
    }

    public function testEmptyColorShouldBeBlack()
    {
        $rgba = new Rgba();

        $empty = new RgbComponent();
        $this->assertEquals($empty, $rgba->getRed());
        $this->assertEquals($empty, $rgba->getGreen());
        $this->assertEquals($empty, $rgba->getBlue());
    }

    public function testEmptyColorShouldBeOpaque()
    {
        $rgba = new Rgba();

        $this->assertEquals(new Alpha(1), $rgba->getAlpha());
    }

    public function testColorShouldReturnDefinedValues()
    {
        $rgba = new Rgba(100, 150, 200, 0.5);

        $this->assertEquals(new RgbComponent(100), $rgba->getRed());
        $this->assertEquals(new RgbComponent(150), $rgba->getGreen());
        $this->assertEquals(new RgbComponent(200), $rgba->getBlue());
        $this->assertEquals(new Alpha(0.5), $rgba->getAlpha());
    }

    public function testCreateWithUnitsShouldReturnCorrectColor()
    {
        $color = new Rgba(new RgbComponent(120), new RgbComponent(75), new RgbComponent(95), new Alpha(0.5));

        $this->assertEquals(new Rgba(120, 75, 95, 0.5), $color);
    }
}
