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

    public function testCreateSameColorTranslatorShouldReturnTranslator()
    {
        $color = new Hsl(10, 20, 30);
        $translator = TranslatorFactory::create($color, "hsl");

        $this->assertInstanceOf('Rainbow\Translator\NullTranslator', $translator);
    }

    /**
     * @dataProvider getUnformattedColorNameDataProvider
     */
    public function testUnformattedColorNameShouldReturnTranslator($color, $resultingColorName, $expected)
    {
        $translator = TranslatorFactory::create($color, $resultingColorName);

        $this->assertInstanceOf($expected, $translator);
    }

    public function getUnformattedColorNameDataProvider()
    {
        return array(
            array(new Rgb(0, 0, 0), 'HSL', 'Rainbow\Translator\RgbToHslTranslator'),
            array(new Rgb(0, 0, 0), ' HsL ', 'Rainbow\Translator\RgbToHslTranslator'),
            array(new Hsl(0, 0, 0), ' RGb ', 'Rainbow\Translator\HslToRgbTranslator'),
        );
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testIncorrectColorNameShouldThrowException()
    {
        $color = new Hsl(0, 0, 0);
        TranslatorFactory::create($color, "lorem");
    }
}
