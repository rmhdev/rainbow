<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests;

use Rainbow\Rgb;

class RgbTest extends \PHPUnit_Framework_TestCase
{

    public function testEmptyColorShouldReturnBlack()
    {
        $color = new Rgb();

        $this->assertEquals(0, $color->getRed());
        $this->assertEquals(0, $color->getGreen());
        $this->assertEquals(0, $color->getBlue());
    }
}
