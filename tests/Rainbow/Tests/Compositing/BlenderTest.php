<?php

namespace Rainbow\Tests\Compositing;

use Rainbow\Compositing\Blender;
use Rainbow\Rgba;

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
        return new Rgba(100, 150, 200, 1);
    }


    public function testGetColorShouldReturnColor()
    {
        $this->assertEquals($this->createBaseColor(), $this->blender->getColor());
    }

    public function testMultiplyShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgba', $this->blender->multiply($this->createNewColor()));
    }

    private function createNewColor()
    {
        return new Rgba(255, 102, 0, 1);
    }

    public function testScreenShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgba', $this->blender->screen($this->createNewColor()));
    }

    public function testOverlayShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgba', $this->blender->overlay($this->createNewColor()));
    }

    public function testHardLightShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgba', $this->blender->hardLight($this->createNewColor()));
    }

    public function testSoftLightShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgba', $this->blender->softLight($this->createNewColor()));
    }

    public function testDifferenceShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgba', $this->blender->difference($this->createNewColor()));
    }

    public function testExclusionShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgba', $this->blender->exclusion($this->createNewColor()));
    }

    public function testColorDodgeShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgba', $this->blender->colorDodge($this->createNewColor()));
    }

    public function testColorBurnShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgba', $this->blender->colorBurn($this->createNewColor()));
    }

    public function testNormalShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgba', $this->blender->normal($this->createNewColor()));
    }

    public function testDarkenShouldReturnColor()
    {
        $this->assertInstanceOf('Rainbow\Rgba', $this->blender->darken($this->createNewColor()));
    }
}
