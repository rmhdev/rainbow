<?php

namespace Rainbow\Tests\Translator;

use Rainbow\Translator\RgbToHslTranslator;

class RgbToHslTranslatorTest extends AbstractTranslatorTest
{
    /**
     * @dataProvider getRgbHslEquivalenceDataProvider
     */
    public function testConvertShouldReturnEquivalentHslColor($rgbValues, $hslValues)
    {
        $translator = new RgbToHslTranslator($this->createRgb($rgbValues));

        $this->assertEquals($this->createHsl($hslValues), $translator->translate());
    }


}
