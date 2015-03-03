<?php

namespace Rainbow\Tests\Translator;

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
}
