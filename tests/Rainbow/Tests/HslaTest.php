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
use Rainbow\Unit\Alpha;
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

    public function testEmptyColorShouldBeOpaque()
    {
        $color = new Hsla();

        $this->assertEquals(new Alpha(1), $color->getAlpha());
    }

    public function testColorShouldReturnDefinedValues()
    {
        $color = new Hsla(180, 25, 75, 0.5);

        $this->assertEquals(new Angle(180), $color->getHue());
        $this->assertEquals(new Percent(25), $color->getSaturation());
        $this->assertEquals(new Percent(75), $color->getLightness());
        $this->assertEquals(new Alpha(0.5), $color->getAlpha());
    }

    public function testCreateWithUnitsShouldReturnCorrectColor()
    {
        $color = new Hsla(new Angle(120), new Percent(75), new Percent(95), new Alpha(0.5));

        $this->assertEquals(new Hsla(120, 75, 95, 0.5), $color);
    }
}
