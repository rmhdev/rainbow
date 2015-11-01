<?php

namespace Rainbow\Tests\Calculation\Channel;

use Rainbow\Calculation\Channel\Luma;
use Rainbow\Rgb;
use Rainbow\Component\Percent;

class LumaTest extends \PHPUnit_Framework_TestCase
{
    public function testBlackShouldReturnMinValue()
    {
        $color = new Rgb(0, 0, 0);
        $operation = new Luma($color);

        $this->assertEquals(new Percent(0), $operation->result());
    }

    public function testWhiteShouldReturnMaxValue()
    {
        $color = new Rgb(255, 255, 255);
        $operation = new Luma($color);

        $this->assertEquals(new Percent(100), $operation->result());
    }

    /**
     * @dataProvider getColorDataProvider
     * @param $expected
     * @param $value
     */
    public function testColorShouldReturnValidPercentage($expected, $value)
    {
        $color = new Rgb($value["red"], $value["green"], $value["blue"]);
        $operation = new Luma($color);

        $this->assertEquals(new Percent($expected), $operation->result());
    }

    public function getColorDataProvider()
    {
        return array(
            array(13, array("red" => 100, "green" => 100, "blue" => 100)),
            array(35, array("red" => 160, "green" => 160, "blue" => 160)),
            array(44, array("red" => 100, "green" => 200, "blue" => 30)),
        );
    }
}
