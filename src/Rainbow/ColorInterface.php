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
     * @param number|string $saturation  A percentage
     * @return ColorInterface
     */
    public function saturate($saturation);

    /**
     * Decrease the saturation of a color in the HSL color space
     * @param number|string $saturation  A percentage
     * @return ColorInterface
     */
    public function desaturate($saturation);

    /**
     * Increase the lightness of a color in the HSL color space
     * @param number|string $lightness  A percentage
     * @return ColorInterface
     */
    public function lighten($lightness);

}
