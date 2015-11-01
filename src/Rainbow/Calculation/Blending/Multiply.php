<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Calculation\Blending;

use Rainbow\Calculation\CalculationInterface;
use Rainbow\Component\Rgb;

final class Multiply extends AbstractBlending implements CalculationInterface
{
    /**
     * {@inheritDoc}
     */
    protected function blend(Rgb $value1, Rgb $value2)
    {
        return $this->multiply($value1, $value2);
    }
}
