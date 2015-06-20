<?php

namespace Rainbow\Tests;

use Rainbow\Rgba;

class RgbaTest extends \PHPUnit_Framework_TestCase
{
    public function testGetNameShouldReturnConstName()
    {
        $rgba = new Rgba();

        $this->assertEquals("rgba", $rgba->getName());
    }
}
