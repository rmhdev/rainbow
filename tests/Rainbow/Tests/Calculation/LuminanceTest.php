<?php

namespace Rainbow\Tests\Calculation;

use Rainbow\Calculation\Luminance;
use Rainbow\Rgb;
use Rainbow\Unit\Percent;

class LuminanceTest extends \PHPUnit_Framework_TestCase
{
    public function testLuminanceInBlackShouldReturnMinValue()
    {
        $color = new Rgb(0, 0, 0);
        $luminance = new Luminance($color);

        $this->assertEquals(new Percent(0), $luminance->result());
    }

    public function testLuminanceInWhiteShouldReturnMaxValue()
    {
        $color = new Rgb(255, 255, 255);
        $luminance = new Luminance($color);

        $this->assertEquals(new Percent(100), $luminance->result());
    }

    /**
     * @dataProvider getLuminanceDataProvider
     */
    public function testLuminanceShouldReturnValidPercentage($expected, $value)
    {
        $color = new Rgb($value["red"], $value["green"], $value["blue"]);
        $luminance = new Luminance($color);

        $this->assertEquals(new Percent($expected), $luminance->result());
    }

    public function getLuminanceDataProvider()
    {
        return array(
            array(13, array("red" => 100, "green" => 100, "blue" => 100)),
            array(35, array("red" => 160, "green" => 160, "blue" => 160)),
        );
    }
}
