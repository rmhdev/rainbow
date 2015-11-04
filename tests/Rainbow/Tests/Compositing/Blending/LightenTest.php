<?php

namespace Rainbow\Tests\Compositing\Blending;

use Rainbow\Compositing\Blending\Lighten;
use Rainbow\Rgba;

class LightenTest extends \PHPUnit_Framework_TestCase
{
    public function testLightenWhiteWithBlackShouldReturnWhiteColor()
    {
        $black = new Rgba(0, 0, 0, 1);
        $white = new Rgba(255, 255, 255, 1);
        $blendA = new Lighten($black, $white);
        $blendB = new Lighten($white, $black);

        $this->assertEquals($white, $blendA->result());
        $this->assertEquals($white, $blendB->result());
    }

    public function testLightenWhiteWithGreyShouldReturnWhiteColor()
    {
        $grey = new Rgba(128, 128, 128, 1);
        $white = new Rgba(255, 255, 255, 1);
        $blendA = new Lighten($grey, $white);
        $blendB = new Lighten($white, $grey);

        $this->assertEquals($white, $blendA->result());
        $this->assertEquals($white, $blendB->result());
    }

    public function testLightenWhiteColorsShouldReturnColorWithMaxValues()
    {
        $colorA = new Rgba(50, 150, 250, 1);
        $colorB = new Rgba(25, 175, 225, 1);
        $blendA = new Lighten($colorA, $colorB);
        $blendB = new Lighten($colorB, $colorA);

        $expected = new Rgba(
            max($colorA->getRed()->getValue(), $colorB->getRed()->getValue()),
            max($colorA->getGreen()->getValue(), $colorB->getGreen()->getValue()),
            max($colorA->getBlue()->getValue(), $colorB->getBlue()->getValue()),
            1
        );

        $this->assertEquals($expected, $blendA->result());
        $this->assertEquals($expected, $blendB->result());
    }
}
