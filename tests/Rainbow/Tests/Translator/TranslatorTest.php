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
}
