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
            array(new Rgb(51, 20, 0), new Rgb(255, 102, 0), new Rgb(51, 51, 51)),
            array(new Rgb(102, 41, 0), new Rgb(255, 102, 0), new Rgb(102, 102, 102)),
            array(new Rgb(0, 0, 0), new Rgb(255, 102, 0), new Rgb(0, 0, 255)),
        );
    }
}
