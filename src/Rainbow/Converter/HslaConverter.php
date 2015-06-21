<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Converter;

use Rainbow\Hsla;

final class HslaConverter
{
    private $color;

    public function __construct(Hsla $color)
    {
        $this->color = $color;
    }

    public function getColor()
    {
        return clone $this->color;
    }
}
