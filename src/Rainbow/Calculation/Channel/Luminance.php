<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Calculation\Channel;

use Rainbow\Calculation\CalculationInterface;

final class Luminance extends AbstractLuma implements CalculationInterface
{
    /**
     * No need for gamma correction
     * {@inheritDoc}
     */
    protected function gammaCorrection($value)
    {
        return $value;
    }
}
