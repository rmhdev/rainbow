<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests;

use Rainbow\Hsla;
use Rainbow\Unit\Angle;
use Rainbow\Unit\Percent;

class HslaTest extends \PHPUnit_Framework_TestCase
{
    public function testGetNameShouldReturnConstName()
    {
        $color = new Hsla();

        $this->assertEquals("hsla", $color->getName());
    }

    public function testEmptyColorShouldReturnBlack()
    {
        $color = new Hsla();

        $this->assertEquals(new Angle(0), $color->getHue());
        $this->assertEquals(new Percent(0), $color->getSaturation());
        $this->assertEquals(new Percent(0), $color->getLightness());
    }
}
