<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Calculation\Blending;

use Rainbow\Rgb;

final class Screen
{
    private $result;

    public function __construct(Rgb $color1, Rgb $color2)
    {
        $this->result = $color2->getRed()->getValue() ? $color2 : $color1;
    }

    public function result()
    {
        return $this->result->copy();
    }
}
