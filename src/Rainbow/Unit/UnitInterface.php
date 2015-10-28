<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Unit;

interface UnitInterface
{
    /**
     * @return number
     */
    public function getValue();

    /**
     * @return string
     */
    public function __toString();

    /**
     * @return mixed
     */
    public static function maxValue();
}
