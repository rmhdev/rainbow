<?php

namespace Rainbow\Tests\Translator;

use Rainbow\Hsl;
use Rainbow\Rgb;
use Rainbow\Translator\RgbToHslTranslator;

class RgbToHslTranslatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getRgbHslEquivalenceDataProvider
     */
    public function testConvertShouldReturnEquivalentHslColor($rgbValue, $hslValue)
    {
        $value = new Rgb(
            $rgbValue["red"],
            $rgbValue["green"],
            $rgbValue["blue"]
        );
        $expected = new Hsl(
            $hslValue["hue"],
            $hslValue["saturation"],
            $hslValue["lightness"]
        );

        $translator = new RgbToHslTranslator($value);

        $this->assertEquals($expected, $translator->translate());
    }

    public function getRgbHslEquivalenceDataProvider()
    {
        return array(
            array(
                array("red" => 0, "green" => 0, "blue" => 0),
                array("hue" => 0, "saturation" => 0, "lightness" => 0)
            ),
            array(
                array("red" => 255, "green" => 0, "blue" => 255),
                array("hue" => 300, "saturation" => 100, "lightness" => 50)
            ),
            array(
                array("red" => 0, "green" => 128, "blue" => 0),
                array("hue" => 120, "saturation" => 100, "lightness" => 25)
            ),
            array(
                array("red" => 255, "green" => 128, "blue" => 0),
                array("hue" => 30, "saturation" => 100, "lightness" => 50)
            ),
            array(
                array("red" => 0, "green" => 128, "blue" => 255),
                array("hue" => 210, "saturation" => 100, "lightness" => 50)
            ),
            array(
                array("red" => 128, "green" => 230, "blue" => 26),
                array("hue" => 90, "saturation" => 80, "lightness" => 50)
            ),
        );
    }
}
