<?php

namespace Rainbow\Tests\Compositing\Blending;

use Rainbow\Compositing\Blending\Normal;
use Rainbow\Rgba;

class NormalTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider backdropColors
     * @param Rgba $backdrop
     */
    public function testNormalShouldReturnSourceColor(Rgba $backdrop)
    {
        $source = new Rgba(10, 20, 30);
        $blend = new Normal($backdrop, $source);

        $this->assertEquals($source, $blend->result());
    }

    public function backdropColors()
    {
        return array(
            array(new Rgba(0, 0, 0, 1)),
            array(new Rgba(128, 128, 128, 1)),
            array(new Rgba(255, 255, 255, 1)),
        );
    }

    /**
     * @dataProvider alphaValues
     */
    public function testNormalAlphaShouldReturnColorWithCorrectAlpha($expected, $backdropAlpha, $sourceAlpha)
    {
        $source = new Rgba(110, 120, 130, $sourceAlpha);
        $backdrop = new Rgba(10, 20, 30, $backdropAlpha);
        $blend = new Normal($backdrop, $source);

        $this->assertEquals($expected, $blend->result()->getAlpha()->getValue());
    }

    public function alphaValues()
    {
        return array(
            array(0, 0, 0),
            array(1, 1, 1),
            array(0.5, 1, 0.5),
            array(0.5, 0, 0.5),
        );
    }
}
