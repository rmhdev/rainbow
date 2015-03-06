<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Converter;

use Rainbow\Converter\HslToRgbConverter;

class HslToRgbConverterTest extends AbstractConverterTest
{
    /**
     * @dataProvider getRgbHslEquivalenceDataProvider
     */
    public function testConvertShouldReturnEquivalentHslColor($rgbValues, $hslValues)
    {
        $converter = new HslToRgbConverter($this->createHsl($hslValues));

        $this->assertEquals($this->createRgb($rgbValues), $converter->convert());
    }
}
