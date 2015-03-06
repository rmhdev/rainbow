<?php

namespace Rainbow\Tests\Converter;

use Rainbow\Hsl;
use Rainbow\Rgb;
use Rainbow\Converter\ConverterFactory;

class ConverterFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateRgbToHslConverterShouldReturnConverter()
    {
        $rgb = new Rgb(0, 0, 0);
        $converter = ConverterFactory::create($rgb, "hsl");

        $this->assertInstanceOf('Rainbow\Converter\RgbToHslConverter', $converter);
    }

    public function testCreateHslToRgbConverterShouldReturnConverter()
    {
        $color = new Hsl(0, 0, 0);
        $converter = ConverterFactory::create($color, "rgb");

        $this->assertInstanceOf('Rainbow\Converter\HslToRgbConverter', $converter);
    }

    public function testCreateSameColorConverterShouldReturnConverter()
    {
        $color = new Hsl(10, 20, 30);
        $converter = ConverterFactory::create($color, "hsl");

        $this->assertInstanceOf('Rainbow\Converter\NullConverter', $converter);
    }

    /**
     * @dataProvider getUnformattedColorNameDataProvider
     */
    public function testUnformattedColorNameShouldReturnConverter($color, $resultingColorName, $expected)
    {
        $converter = ConverterFactory::create($color, $resultingColorName);

        $this->assertInstanceOf($expected, $converter);
    }

    public function getUnformattedColorNameDataProvider()
    {
        return array(
            array(new Rgb(0, 0, 0), 'HSL', 'Rainbow\Converter\RgbToHslConverter'),
            array(new Rgb(0, 0, 0), ' HsL ', 'Rainbow\Converter\RgbToHslConverter'),
            array(new Hsl(0, 0, 0), ' RGb ', 'Rainbow\Converter\HslToRgbConverter'),
        );
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testIncorrectColorNameShouldThrowException()
    {
        $color = new Hsl(0, 0, 0);
        ConverterFactory::create($color, "lorem");
    }
}
