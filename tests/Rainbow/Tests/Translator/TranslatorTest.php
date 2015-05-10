<?php

namespace Rainbow\Tests\Translator;

use Rainbow\Rgb;
use Rainbow\Translator\Translator;
use Rainbow\Hsl;

class TranslatorTest extends \PHPUnit_Framework_TestCase
{
    public function testToRgbShouldReturnRgb()
    {
        $converter = new Translator(new Hsl(0, 0, 0));

        $this->assertInstanceOf('Rainbow\Rgb', $converter->toRgb());
    }

    public function testToHslShouldReturnHsl()
    {
        $converter = new Translator(new Rgb(0, 0, 0));

        $this->assertInstanceOf('Rainbow\Hsl', $converter->toHsl());
    }

    public function testToSameColorShouldReturnEqualColor()
    {
        $color = new Rgb(10, 20, 30);
        $converter = new Translator($color);

        $this->assertEquals($color, $converter->toRgb());
    }


    /**
     * @dataProvider toColorDataProvider
     * @param $expectedClass
     * @param $translateTo
     */
    public function testToPassedColorShouldReturnExpectedColor($expectedClass, $translateTo)
    {
        $color = new Rgb(100, 150, 200);
        $converter = new Translator($color);

        $this->assertInstanceOf($expectedClass, $converter->to($translateTo));
    }

    public function toColorDataProvider()
    {
        return array(
            array('Rainbow\Rgb', 'rgb'),
            array('Rainbow\Hsl', 'hsl'),
        );
    }
}
