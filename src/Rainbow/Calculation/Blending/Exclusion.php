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

/**
 * Produces an effect similar to that of the Difference mode but lower in contrast
 * @package Rainbow\Calculation\Blending
 * @link http://www.w3.org/TR/compositing-1/#valdef-blend-mode-exclusion
 */
final class Exclusion extends AbstractBlending implements CalculationInterface
{
    /**
     * {@inheritDoc}
     */
    protected function calculateComponentValue(RgbComponent $component1, RgbComponent $component2)
    {
        $sum = $component1->getValue() + $component2->getValue();
        $prod = 2 * ($component1->getValue() * $component2->getValue()) / RgbComponent::maxValue();

        return $sum - $prod;
    }
}
