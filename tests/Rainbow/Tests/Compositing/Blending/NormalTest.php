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
            array(new Rgba(128, 128, 128, 0.5)),
            array(new Rgba(255, 255, 255, 0)),
        );
    }
}
