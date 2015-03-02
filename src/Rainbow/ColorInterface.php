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
     * Convert to RGB color space
     * @return Rgb
     */
    public function toRgb();

    /**
     * Convert to HSL color space
     * @return Hsl
     */
    public function toHsl();

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
}
