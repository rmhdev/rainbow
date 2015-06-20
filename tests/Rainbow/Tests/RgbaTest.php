<?php

namespace Rainbow\Tests;

use Rainbow\Rgba;
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
}
