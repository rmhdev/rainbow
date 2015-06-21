<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Converter;

use Rainbow\Converter\HslaConverter;
use Rainbow\Hsla;

class HslaConverterTest extends \PHPUnit_Framework_TestCase
{
    public function testGetColorShouldReturnHsla()
    {
        $color = new Hsla(180, 50, 75, 0.5);
        $converter = new HslaConverter($color);

        $this->assertEquals($color, $converter->getColor());
    }
}
