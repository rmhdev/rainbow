<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow;

use Rainbow\Unit\Alpha;
use Rainbow\Unit\Percent;
use Rainbow\Translator\Translator;

interface ColorInterface
{
    /**
     * String representation of the color
     * @return string
     */
    public function __toString();

    /**
     * Name of the color
     * @return string
     */
    public function getName();

    /**
     * Extract the alpha channel
     * @return Alpha
     */
    public function getAlpha();

    /**
     * Translator object to convert the color space
     * @return Translator
     */
    public function translate();

    /**
     * Create a copy of the color
     * @return ColorInterface
     */
    public function copy();

    /**
     * Calculates the luma (perceptual brightness) of a color in the RGB color space
     * @return Percent
     * @link http://www.w3.org/TR/2008/REC-WCAG20-20081211/#relativeluminancedef
     */
    public function luma();

    /**
     * Calculates the luma without gamma correction
     * @see self::luma
     * @return Percent
     */
    public function luminance();

    /**
     * Increase the saturation of a color in the HSL color space
     * @param number|string $percentage  A percentage
     * @return ColorInterface
     */
    public function saturate($percentage);

    /**
     * Decrease the saturation of a color in the HSL color space
     * @param number|string $percentage  A percentage
     * @return ColorInterface
     */
    public function desaturate($percentage);

    /**
     * Increase the lightness of a color in the HSL color space
     * @param number|string $percentage  A percentage
     * @return ColorInterface
     */
    public function lighten($percentage);

    /**
     * Decrease the lightness of a color in the HSL color space
     * @param number|string $percentage  A percentage
     * @return ColorInterface
     */
    public function darken($percentage);

    /**
     * Rotate the hue angle of a color in either direction
     * @param number|string $angle  An Angle
     * @return ColorInterface
     */
    public function spin($angle);

    /**
     * Remove all saturation from a color in the HSL color space
     * @return ColorInterface
     */
    public function greyscale();

    /**
     * Choose which of two colors provides the greatest contrast
     * @uses self::luma to calculate the contrast
     * @param ColorInterface $dark
     * @param ColorInterface $light
     * @return ColorInterface
     */
    public function contrast(ColorInterface $dark, ColorInterface $light);

    /**
     * Multiply with the color
     * @param ColorInterface $color
     * @return ColorInterface
     */
    public function multiply(ColorInterface $color);

    /**
     * Do the opposite of multiply
     * @see self::multiply
     * @param ColorInterface $color
     * @return ColorInterface
     */
    public function screen(ColorInterface $color);

    /**
     * Inverse of HardLight
     * @see self::hardLight
     * @param ColorInterface $color
     * @return ColorInterface
     */
    public function overlay(ColorInterface $color);

    /**
     * Multiplies or screens the colors, depending on the source color value
     * @see self::multiply
     * @see self::screen
     * @param ColorInterface $color
     * @return mixed
     */
    public function hardLight(ColorInterface $color);
}
