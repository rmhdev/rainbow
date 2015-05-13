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
        $max = RgbComponent::MAX_VALUE;
        if ($component1->getValue() <= ceil(RgbComponent::MAX_VALUE / 2)) {
            return 2 * $component1->getValue() * $component2->getValue() / $max;
        }

        return $max - 2 * ($max - $component1->getValue()) * ($max - $component2->getValue()) / $max;
    }
}
