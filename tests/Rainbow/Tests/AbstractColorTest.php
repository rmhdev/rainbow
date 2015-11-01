<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests;

use Rainbow\Calculation\Blender;
use Rainbow\Hsl;
use Rainbow\Rgb;
use Rainbow\ColorInterface;
use Rainbow\Rgba;
use Rainbow\Component\Angle;
use Rainbow\Component\Percent;

abstract class AbstractColorTest extends \PHPUnit_Framework_TestCase
{
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

        $this->assertInstanceOf('Rainbow\Component\Percent', $color->luma());
    }

    public function testLuminanceShouldReturnPercent()
    {
        $hsl = new Hsl();
        $color = $this->toCurrent($hsl);

        $this->assertInstanceOf('Rainbow\Component\Percent', $color->luminance());
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

    public function testGetBlenderShouldReturnBlender()
    {
        $hsl = new Hsl(180, 50, 50);
        $rgb = $hsl->translate()->toRgb();
        $blender = new Blender(
            new Rgba(
                $rgb->getRed(),
                $rgb->getGreen(),
                $rgb->getBlue(),
                1
            )
        );

        $this->assertEquals($blender, $this->toCurrent($hsl)->getBlender());
    }
}
