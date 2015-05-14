<?php

namespace Rainbow\Tests\Calculation\Blending;

use Rainbow\Calculation\Blending\SoftLight;
use Rainbow\Rgb;

class SoftLightTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider overlayDataProvider
     * @param Rgb $expected
     * @param Rgb $color
     */
    public function testColorShouldReturnCorrectColor(Rgb $expected, Rgb $color)
    {
        $baseColor = new Rgb(255, 102, 0);
        $overlay = new SoftLight($baseColor, $color);

        $this->assertEquals($expected, $overlay->result());
    }

    public function overlayDataProvider()
    {
        return array(
            array(new Rgb(255, 41, 0), new Rgb(0, 0, 0)),
            array(new Rgb(255, 65, 0), new Rgb(51, 51, 51)),
            array(new Rgb(255, 90, 0), new Rgb(102, 102, 102)),
            array(new Rgb(255, 114, 0), new Rgb(153, 153, 153)),
            //array(new Rgb(255, 138, 0), new Rgb(204, 204, 204)),
            //array(new Rgb(255, 161, 0), new Rgb(255, 255, 255)),
//            array(new Rgb(255, 0, 0), new Rgb(255, 0, 0)),
//            array(new Rgb(255, 204, 0), new Rgb(0, 255, 0)),
//            array(new Rgb(255, 0, 0), new Rgb(0, 0, 255)),
        );
    }
}
