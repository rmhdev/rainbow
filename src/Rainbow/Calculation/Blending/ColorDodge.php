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
 * Brightens the backdrop color to reflect the source color
 * @package Rainbow\Calculation\Blending
 * @link http://www.w3.org/TR/compositing-1/#valdef-blend-mode-color-dodge
 */
final class ColorDodge extends AbstractBlending implements CalculationInterface
{
    /**
     * {@inheritDoc}
     */
    protected function calculateComponentValue(RgbComponent $component1, RgbComponent $component2)
    {
        $value1 = $component1->getValue() / RgbComponent::MAX_VALUE;
        $value2 = $component2->getValue() / RgbComponent::MAX_VALUE;
        if ($value1 == 0) {
            return 0;
        }
        if ($value2 == 1) {
            return RgbComponent::MAX_VALUE;
        }

        return min(1, $value1 / (1 - $value2)) * RgbComponent::MAX_VALUE;
    }
}
