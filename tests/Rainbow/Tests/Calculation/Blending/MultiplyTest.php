<?php

namespace Rainbow\Tests\Calculation\Blending;

use Rainbow\Calculation\Blending\Multiply;
use Rainbow\Rgb;

class MultiplyTest extends \PHPUnit_Framework_TestCase
{
    public function testMultiplyBlackShouldReturnBlack()
    {
        $black = new Rgb();
        $operation = new Multiply($black, $black);

        $this->assertEquals($black, $operation->result());
    }

    public function testMultiplyWhiteShouldReturnWhite()
    {
        $white = new Rgb(255, 255, 255);
        $operation = new Multiply($white, $white);

        $this->assertEquals($white, $operation->result());
    }

    /**
     * @dataProvider multiplyDataProvider
     * @param Rgb $expected
     * @param Rgb $colorA
     * @param Rgb $colorB
     */
    public function testMultiplyColorsShouldReturnCorrectColor(Rgb $expected, Rgb $colorA, Rgb $colorB)
    {
        $operation = new Multiply($colorA, $colorB);

        $this->assertEquals($expected, $operation->result());
    }

    public function multiplyDataProvider()
    {
        return array(
            array(new Rgb(100, 0, 0), new Rgb(255, 0, 0), new Rgb(100, 0, 0)),
            array(new Rgb(100, 100, 0), new Rgb(255, 255, 0), new Rgb(100, 100, 0)),
            array(new Rgb(100, 100, 100), new Rgb(255, 255, 255), new Rgb(100, 100, 100)),
            array(new Rgb(39, 39, 39), new Rgb(100, 100, 100), new Rgb(100, 100, 100)),
        );
    }
}
