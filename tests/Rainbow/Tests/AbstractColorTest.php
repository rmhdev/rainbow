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
use Rainbow\Unit\Percent;
use Rainbow\ColorInterface;

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

    public function testSaturateShouldIncreaseSaturationInNewColor()
    {
        $hsl = new Hsl(180, 50, 50);
        $newColor = $this->toCurrent($hsl)->saturate(10);

        $this->assertEquals(new Percent(50), $hsl->getSaturation());
        $this->assertEquals(new Percent(60), $newColor->toHsl()->getSaturation());
    }

    public function testSaturateShouldBeLesserEqualThan100()
    {
        $hsl = new Hsl(180, 80, 50);
        $newColor = $this->toCurrent($hsl);

        $this->assertEquals("100%", (string)$newColor->saturate(30)->toHsl()->getSaturation());
    }

    public function testDesaturateShouldDecreaseSaturationInNewColor()
    {
        $hsl = new Hsl(180, 80, 50);
        $newColor = $this->toCurrent($hsl)->desaturate(10);

        $this->assertEquals(new Percent(80), $hsl->getSaturation());
        $this->assertEquals(new Percent(70), $newColor->toHsl()->getSaturation());
    }

    public function testDesaturateShouldBeGreaterEqualThanZero()
    {
        $hsl = new Hsl(180, 20, 50);
        $newColor = $this->toCurrent($hsl)->desaturate(30);

        $this->assertEquals("0%", (string)$newColor->toHsl()->getSaturation());
    }

    public function testLightenShouldIncreaseLightnessInNewColor()
    {
        $hsl = new Hsl(180, 50, 50);
        $newColor = $this->toCurrent($hsl)->lighten(20);

        $this->assertEquals(new Percent(50), $hsl->getLightness());
        $this->assertEquals(new Percent(70), $newColor->toHsl()->getLightness());
    }

    public function testLightenShouldBeLesserEqualThan100()
    {
        $hsl = new Hsl(180, 50, 80);
        $newColor = $this->toCurrent($hsl)->lighten(30);

        $this->assertEquals("100%", (string)$newColor->toHsl()->getLightness());
    }

    public function testDarkenShouldDecreaseLightnessInNewColor()
    {
        $hsl = new Hsl(90, 80, 50);
        $newColor = $this->toCurrent($hsl)->darken(30);

        $this->assertEquals(new Percent(50), $hsl->getLightness());
        $this->assertEquals(new Percent(20), $newColor->toHsl()->getLightness());
    }

    public function testDarkenShouldBeGreaterEqualThanZero()
    {
        $hsl = new Hsl(90, 80, 50);
        $newColor = $this->toCurrent($hsl)->darken(60);

        $this->assertEquals("0%", (string)$newColor->toHsl()->getLightness());
    }

    public function testCopyShouldReturnEqualColor()
    {
        $hsl = new Hsl(10, 20, 30);
        $color = $this->toCurrent($hsl);

        $this->assertEquals($color, $color->copy());
    }

    public function testToSameShouldReturnEqualColor()
    {
        $color = $this->createColor();

        $this->assertEquals((string)$color, (string)$color->to($color->getName()));
    }

    /**
     * @return ColorInterface
     */
    abstract protected function createColor();

    public function testGetTranslatorShouldReturnTranslator()
    {
        $color = $this->createColor();

        $this->assertInstanceOf('Rainbow\Translator\Translator', $color->getTranslator());
    }
}
