<?php

namespace Rainbow\Tests\Translator;

use Rainbow\Hsl;
use Rainbow\Rgb;
use Rainbow\Translator\TranslatorFactory;

class TranslatorFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateRgbToHslTranslatorShouldReturnTranslator()
    {
        $rgb = new Rgb(0, 0, 0);
        $translator = TranslatorFactory::create($rgb, "hsl");

        $this->assertInstanceOf('Rainbow\Translator\RgbToHslTranslator', $translator);
    }

    public function testCreateHslToRgbTranslatorShouldReturnTranslator()
    {
        $color = new Hsl(0, 0, 0);
        $translator = TranslatorFactory::create($color, "rgb");

        $this->assertInstanceOf('Rainbow\Translator\HslToRgbTranslator', $translator);
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testCreateSameColorTranslatorShouldThrowException()
    {
        $color = new Hsl(0, 0, 0);
        TranslatorFactory::create($color, "hsl");
    }
}