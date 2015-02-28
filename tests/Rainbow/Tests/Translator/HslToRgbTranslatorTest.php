<?php

namespace Rainbow\Tests\Translator;

use Rainbow\Translator\HslToRgbTranslator;

class HslToRgbTranslatorTest extends AbstractTranslatorTest
{
    /**
     * @dataProvider getRgbHslEquivalenceDataProvider
     */
    public function testConvertShouldReturnEquivalentHslColor($rgbValues, $hslValues)
    {
        $translator = new HslToRgbTranslator($this->createHsl($hslValues));

        $this->assertEquals($this->createRgb($rgbValues), $translator->translate());
    }
}