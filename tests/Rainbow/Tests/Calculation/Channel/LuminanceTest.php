<?php

namespace Rainbow\Tests\Calculation\Channel;

use Rainbow\Calculation\Channel\Luminance;
use Rainbow\Rgb;
use Rainbow\Unit\Percent;

class LuminanceTest extends \PHPUnit_Framework_TestCase
{
    public function testBlackShouldReturnMinValue()
    {
        $color = new Rgb(0, 0, 0);
        $operation = new Luminance($color);

        $this->assertEquals(new Percent(0), $operation->result());
    }

    public function testWhiteShouldReturnMinValue()
    {
        $color = new Rgb(255, 255, 255);
        $operation = new Luminance($color);

        $this->assertEquals(new Percent(100), $operation->result());
    }

    /**
     * @dataProvider getColorDataProvider
     * @param int $expected
     * @param array $value
     */
    public function testColorShouldReturnValidPercentage($expected, $value)
    {
        $color = new Rgb($value["red"], $value["green"], $value["blue"]);
        $operation = new Luminance($color);

        $this->assertEquals(new Percent($expected), $operation->result());
    }

    public function getColorDataProvider()
    {
        return array(
            array(65, array("red" => 100, "green" => 200, "blue" => 30)),
        );
    }
}
