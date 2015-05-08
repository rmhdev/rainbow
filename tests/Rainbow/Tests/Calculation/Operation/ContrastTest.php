<?php

namespace Rainbow\Tests\Calculation\Operation;

use Rainbow\Calculation\Operation\Contrast;
use Rainbow\Rgb;

class ContrastTest extends \PHPUnit_Framework_TestCase
{
    public function testWhiteReturnsDarkColor()
    {
        $rgb = new Rgb(255, 255, 255);
        $dark = new Rgb(50, 50, 50);
        $light = new Rgb(200, 200, 200);
        $operation = new Contrast($rgb, $dark, $light);

        $this->assertEquals($dark, $operation->result());
    }

    public function testBlackReturnsLightColor()
    {
        $rgb = new Rgb(0, 0, 0);
        $dark = new Rgb(50, 50, 50);
        $light = new Rgb(200, 200, 200);
        $operation = new Contrast($rgb, $dark, $light);

        $this->assertEquals($light, $operation->result());
    }

    /**
     * @dataProvider contrastDataProvider
     * @param string $expectedName
     * @param array $colors
     */
    public function testContrastShouldReturnExpectedColor($expectedName, $colors)
    {
        $contrast = new Contrast($colors["color"], $colors["dark"], $colors["light"]);

        $this->assertEquals($colors[$expectedName], $contrast->result());
    }

    public function contrastDataProvider()
    {
        return array(
            array(
                "light", array(
                    "color" => new Rgb(100, 100, 100),
                    "dark" => new Rgb(50, 50, 50),
                    "light" => new Rgb(200, 200, 200),
                )
            )
        );
    }
}
