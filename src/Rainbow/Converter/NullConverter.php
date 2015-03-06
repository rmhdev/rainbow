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

final class NullConverter implements ConverterInterface
{
    /**
     * @param ColorInterface $color
     */
    public function __construct(ColorInterface $color)
    {
        $this->color = $color;
    }

    /**
     * Returns the same color
     * {@inheritDoc}
     */
    public function convert()
    {
        return $this->color->copy();
    }
}
