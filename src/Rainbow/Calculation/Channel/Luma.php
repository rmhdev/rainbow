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

final class Luma extends AbstractLuminance implements CalculationInterface
{
    /**
     * {@inheritDoc}
     */
    protected function gammaCorrection($value)
    {
        return ($value <= 0.03928) ? $value / 12.92 : (($value + 0.055) / 1.055) ** 2.4;
    }
}
