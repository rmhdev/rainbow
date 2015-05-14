<?php

namespace Rainbow\Tests\Calculation;

use Rainbow\Calculation\Blender;
use Rainbow\Rgb;

class BlenderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Blender
     */
    private $blender;

    protected function setUp()
    {
        $this->blender = new Blender($this->createBaseColor());
    }

    protected function tearDown()
    {
        unset($this->blender);
    }

    private function createBaseColor()
    {
        return new Rgb(100, 150, 200);
    }


    public function testGetColorShouldReturnColor()
    {
        $this->assertEquals($this->createBaseColor(), $this->blender->getColor());
    }

    public function testMultiplyShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgb', $this->blender->multiply($this->createNewColor()));
    }

    private function createNewColor()
    {
        return new Rgb(255, 102, 0);
    }

    public function testScreenShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgb', $this->blender->screen($this->createNewColor()));
    }

    public function testOverlayShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgb', $this->blender->overlay($this->createNewColor()));
    }

    public function testHardLightShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgb', $this->blender->hardLight($this->createNewColor()));
    }

    public function testSoftLightShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgb', $this->blender->softLight($this->createNewColor()));
    }

    public function testDifferenceShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgb', $this->blender->difference($this->createNewColor()));
    }

    public function testExclusionShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgb', $this->blender->exclusion($this->createNewColor()));
    }

    public function testColorDodgeShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgb', $this->blender->colorDodge($this->createNewColor()));
    }

    public function testColorBurnShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgb', $this->blender->colorBurn($this->createNewColor()));
    }
}
