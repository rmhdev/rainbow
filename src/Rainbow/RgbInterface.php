<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow;

use Rainbow\Component\Rgb;

interface RgbInterface
{
    /**
     * @return Rgb
     */
    public function getRed();

    /**
     * @return Rgb
     */
    public function getGreen();

    /**
     * @return Rgb
     */
    public function getBlue();
}
