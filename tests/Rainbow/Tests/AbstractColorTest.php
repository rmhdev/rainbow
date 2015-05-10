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

    public function testSaturateShouldReturnUpdatedColor()
    {
        $hsl = new Hsl(180, 50, 50);
        $color = $this->toCurrent($hsl)->saturate(10);

        $this->assertEquals(new Percent(60), $color->translate()->toHsl()->getSaturation());
    }

    public function testDesaturateShouldReturnUpdatedColor()
    {
        $hsl = new Hsl(180, 50, 50);
        $color = $this->toCurrent($hsl)->desaturate(10);

        $this->assertEquals(new Percent(40), $color->translate()->toHsl()->getSaturation());
    }

    public function testLightenShouldReturnUpdatedColor()
    {
        $hsl = new Hsl(180, 50, 50);
        $color = $this->toCurrent($hsl)->lighten(10);

        $this->assertEquals(new Percent(60), $color->translate()->toHsl()->getLightness());
    }

    public function testDarkenShouldReturnUpdatedColor()
    {
        $hsl = new Hsl(180, 50, 50);
        $color = $this->toCurrent($hsl)->darken(10);

        $this->assertEquals(new Percent(40), $color->translate()->toHsl()->getLightness());
    }

    public function testSpinShouldReturnUpdatedColor()
    {
        $hsl = new Hsl(180, 50, 50);
        $color = $this->toCurrent($hsl)->spin(10);

        $this->assertEquals(new Angle(190), $color->translate()->toHsl()->getHue());
    }

    public function testCopyShouldReturnEqualColor()
    {
        $hsl = new Hsl(10, 20, 30);
        $color = $this->toCurrent($hsl);

        $this->assertEquals($color, $color->copy());
    }

    public function testTranslateShouldReturnTranslator()
    {
        $color = $this->toCurrent(new Hsl());

        $this->assertInstanceOf('Rainbow\Translator\Translator', $color->translate());
    }

    public function testLumaShouldReturnPercent()
    {
        $hsl = new Hsl();
        $color = $this->toCurrent($hsl);

        $this->assertInstanceOf('Rainbow\Unit\Percent', $color->luma());
    }

    public function testLuminanceShouldReturnPercent()
    {
        $hsl = new Hsl();
        $color = $this->toCurrent($hsl);

        $this->assertInstanceOf('Rainbow\Unit\Percent', $color->luminance());
    }

    public function testGreyscaleShouldReturnColorWithoutSaturation()
    {
        $hsl = new Hsl(90, 90, 50);
        $color = $this->toCurrent($hsl)->greyscale();

        $this->assertEquals(new Percent(0), $color->translate()->toHsl()->getSaturation());
    }

    public function testContrastShouldReturnColor()
    {
        $color = new Rgb(100, 100, 100);
        $dark = new Rgb(50, 50, 50);
        $light = new Rgb(200, 200, 200);

        $this->assertEquals($light, $color->contrast($dark, $light));
    }

    public function testMultiplyShouldReturnSameColorSpace()
    {
        $color = $this->toCurrent(new Hsl(180, 50, 50));
        $colorMultiply = $this->toCurrent(new Hsl(180, 75, 25));

        $this->assertInstanceOf(get_class($color), $color->multiply($colorMultiply));
    }
}
