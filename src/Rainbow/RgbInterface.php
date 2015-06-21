<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow;

use Rainbow\Unit\RgbComponent;

interface RgbInterface
{
    /**
     * @return RgbComponent
     */
    public function getRed();

    /**
     * @return RgbComponent
     */
    public function getGreen();

    /**
     * @return RgbComponent
     */
    public function getBlue();
}
