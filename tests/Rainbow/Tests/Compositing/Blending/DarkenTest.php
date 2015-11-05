<?php

namespace Rainbow\Tests\Compositing\Blending;

use Rainbow\Compositing\Blending\Darken;
use Rainbow\Rgba;

class DarkenTest extends \PHPUnit_Framework_TestCase
{
    public function testDarkenWhiteWithBlackShouldReturnBlackColor()
    {
        $black = new Rgba(0, 0, 0, 1);
        $white = new Rgba(255, 255, 255, 1);
        $blendA = new Darken($black, $white);
        $blendB = new Darken($white, $black);

        $this->assertEquals($black, $blendA->result());
        $this->assertEquals($black, $blendB->result());
    }

    public function testDarkenWhiteWithGreyShouldReturnGreyColor()
    {
        $grey = new Rgba(128, 128, 128, 1);
        $white = new Rgba(255, 255, 255, 1);
        $blendA = new Darken($grey, $white);
        $blendB = new Darken($white, $grey);

        $this->assertEquals($grey, $blendA->result());
        $this->assertEquals($grey, $blendB->result());
    }

    public function testDarkenWhiteColorsShouldReturnColorWithMinValues()
    {
        $colorA = new Rgba(50, 150, 250, 1);
        $colorB = new Rgba(25, 175, 225, 1);
        $blendA = new Darken($colorA, $colorB);
        $blendB = new Darken($colorB, $colorA);

        $expected = new Rgba(
            min($colorA->getRed()->getValue(), $colorB->getRed()->getValue()),
            min($colorA->getGreen()->getValue(), $colorB->getGreen()->getValue()),
            min($colorA->getBlue()->getValue(), $colorB->getBlue()->getValue()),
            1
        );

        $this->assertEquals($expected, $blendA->result());
        $this->assertEquals($expected, $blendB->result());
    }

    /**
     * @dataProvider alphaValues
     */
    public function testDarkenAlphaShouldReturnColorWithMinAlpha($expected, $backdropAlpha, $sourceAlpha)
    {
        $source = new Rgba(110, 120, 130, $sourceAlpha);
        $backdrop = new Rgba(10, 20, 30, $backdropAlpha);
        $blend = new Darken($backdrop, $source);

        $this->assertEquals($expected, $blend->result()->getAlpha()->getValue());
    }

    public function alphaValues()
    {
        return array(
            array(0, 0, 0),
            array(1, 1, 1),
            array(0, 1, 0),
            array(0.5, 1, 0.5),
        );
    }
}
