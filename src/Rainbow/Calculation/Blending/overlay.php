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

class Overlay extends AbstractBlending implements CalculationInterface
{
    /**
     * {@inheritDoc}
     */
    protected function calculateComponentValue(RgbComponent $component1, RgbComponent $component2)
    {
        $value1 = 2 * $component1->getValue();
        if ($value1 <= RgbComponent::MAX_VALUE) {

            return $this->multiply($value1, $component2->getValue());
        }

        return $this->screen($value1 - RgbComponent::MAX_VALUE, $component2->getValue());
    }
}
