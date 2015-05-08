<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests;

use Rainbow\Hsl;
use Rainbow\Rgb;
use Rainbow\ColorInterface;
use Rainbow\Unit\Angle;
use Rainbow\Unit\Percent;

abstract class AbstractColorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param array $values
     * @return Rgb
     */
    public function createRgb($values)
    {
        return new Rgb(
            $values["red"],
            $values["green"],
            $values["blue"]
        );
    }

    /**
     * @param array $values
     * @return Hsl
     */
    public function createHsl($values)
    {
        return new Hsl(
            $values["hue"],
            $values["saturation"],
            $values["lightness"]
        );
    }

    /**
     * Convert Hsl color space to current color space
     * @param Hsl $color
     * @return ColorInterface
     */
    abstract protected function toCurrent(Hsl $color);

    public function testSaturateShouldReturnColor()
    {
        $hsl = new Hsl(180, 50, 50);
        $color = $this->toCurrent($hsl);

        $this->assertInstanceOf(get_class($color), $color->saturate(10));
        $this->assertEquals(new Percent(60), $color->saturate(10)->translate()->toHsl()->getSaturation());
    }

    public function testDesaturateShouldReturnColor()
    {
        $hsl = new Hsl(180, 50, 50);
        $color = $this->toCurrent($hsl);

        $this->assertInstanceOf(get_class($color), $color->desaturate(10));
        $this->assertEquals(new Percent(40), $color->desaturate(10)->translate()->toHsl()->getSaturation());
    }

    public function testLightenShouldReturnColor()
    {
        $hsl = new Hsl(180, 50, 50);
        $color = $this->toCurrent($hsl);

        $this->assertInstanceOf(get_class($color), $color->lighten(10));
        $this->assertEquals(new Percent(60), $color->lighten(10)->translate()->toHsl()->getLightness());
    }

    public function testDarkenShouldReturnColor()
    {
        $hsl = new Hsl(180, 50, 50);
        $color = $this->toCurrent($hsl);

        $this->assertInstanceOf(get_class($color), $color->darken(10));
        $this->assertEquals(new Percent(40), $color->darken(10)->translate()->toHsl()->getLightness());
    }

    public function testSpinShouldReturnColorWithUpdatedHue()
    {
        $hsl = new Hsl(180, 50, 50);
        $color = $this->toCurrent($hsl);

        $this->assertInstanceOf(get_class($color), $color->spin(10));
        $this->assertEquals(new Angle(190), $color->spin(10)->translate()->toHsl()->getHue());
    }

    public function testCopyShouldReturnEqualColor()
    {
        $hsl = new Hsl(10, 20, 30);
        $color = $this->toCurrent($hsl);

        $this->assertEquals($color, $color->copy());
    }

    /**
     * @return ColorInterface
     */
    abstract protected function createColor();

    public function testTranslateShouldReturnTranslator()
    {
        $color = $this->createColor();

        $this->assertInstanceOf('Rainbow\Translator\Translator', $color->translate());
    }

    public function testLuminanceShouldReturnPercent()
    {
        $hsl = new Hsl();
        $color = $this->toCurrent($hsl);

        $this->assertInstanceOf('Rainbow\Unit\Percent', $color->luminance());
    }
}
