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
 * Darkens or lightens the colors, depending on the source color value
 * @package Rainbow\Calculation\Blending
 * @link http://www.w3.org/TR/compositing-1/#blendingsoftlight
 */
final class SoftLight extends AbstractBlending implements CalculationInterface
{
    /**
     * {@inheritDoc}
     */
    protected function calculateComponentValue(RgbComponent $component1, RgbComponent $component2)
    {
        $value1 = $component1->getValue() / RgbComponent::maxValue();
        $value2 = $component2->getValue() / RgbComponent::maxValue();
        $d = 1;
        $e = $value1;
        if ($value2 > 0.5) {
            $e = 1;
            $d = ($value1 > 0.25) ?
                sqrt($value1) :
                ((16 * $value1 - 12) * $value1 + 4) * $value1;
        }
        $result = $value1 - (1 - 2 * $value2) * $e * ($d - $value1);

        return $result * RgbComponent::maxValue();
    }
}
