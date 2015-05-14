<?php

namespace Rainbow\Calculation\Blending;

use Rainbow\Calculation\CalculationInterface;
use Rainbow\Unit\RgbComponent;

final class ColorDodge extends AbstractBlending implements CalculationInterface
{
    /**
     * @param RgbComponent $component1
     * @param RgbComponent $component2
     * @return int
     */
    protected function calculateComponentValue(RgbComponent $component1, RgbComponent $component2)
    {
        if ($component1->getValue() == 0) {
            return 0;
        }
        if ($component2->getValue() == RgbComponent::MAX_VALUE) {
            return RgbComponent::MAX_VALUE;
        }

        return 500;
    }
}
