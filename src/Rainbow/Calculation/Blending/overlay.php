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
        if ($component1->getValue() <= ceil(RgbComponent::MAX_VALUE / 2)) {

            return $this->multiply($component1, 2 * $component2->getValue());
        }

        return $this->screen($component1, 2 * $component2->getValue() - 1);
    }
}
