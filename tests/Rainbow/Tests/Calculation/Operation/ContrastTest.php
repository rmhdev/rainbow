<?php

namespace Rainbow\Tests\Calculation\Operation;

use Rainbow\Calculation\Operation\Contrast;
use Rainbow\Rgb;

class ContrastTest extends \PHPUnit_Framework_TestCase
{
    public function testWhiteReturnsBlackByDefault()
    {
        $rgb = new Rgb(255, 255, 255);
        $expectedRgb = new Rgb(0, 0, 0);
        $operation = new Contrast($rgb);

        $this->assertEquals($expectedRgb, $operation->result());
    }

    public function testBlackReturnsWhiteByDefault()
    {
        $rgb = new Rgb(0, 0, 0);
        $expectedRgb = new Rgb(255, 255, 255);
        $operation = new Contrast($rgb);

        $this->assertEquals($expectedRgb, $operation->result());
    }

    public function testWhiteReturnsDarkColor()
    {
        $rgb = new Rgb(255, 255, 255);
        $dark = new Rgb(50, 50, 50);
        $operation = new Contrast($rgb, $dark);

        $this->assertEquals($dark, $operation->result());
    }

    public function testBlackReturnsLightColor()
    {
        $rgb = new Rgb(0, 0, 0);
        $light = new Rgb(200, 200, 200);
        $operation = new Contrast($rgb, null, $light);

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
