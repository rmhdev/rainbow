<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

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
