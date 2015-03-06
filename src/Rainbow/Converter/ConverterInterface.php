<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Converter;

use Rainbow\ColorInterface;

interface ConverterInterface
{
    /**
     * Returns the converted color
     * @return ColorInterface
     */
    public function convert();
}
