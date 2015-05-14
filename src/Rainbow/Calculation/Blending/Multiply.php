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
use Rainbow\Unit\RgbComponent;

final class Multiply extends AbstractBlending implements CalculationInterface
{
    /**
     * {@inheritDoc}
     */
    protected function calculateComponentValue(RgbComponent $component1, RgbComponent $component2)
    {
        return $this->multiply($component1, $component2);
    }
}
