<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

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
