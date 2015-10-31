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
 * Darkens the backdrop color to reflect the source color
 * @package Rainbow\Calculation\Blending
 * @link http://www.w3.org/TR/compositing-1/#valdef-blend-mode-color-burn
 */
final class ColorBurn extends AbstractBlending implements CalculationInterface
{
    /**
     * {@inheritDoc}
     */
    protected function blend(RgbComponent $value1, RgbComponent $value2)
    {
        $value1 = $value1->getValue() / $value1::maxValue();
        $value2 = $value2->getValue() / $value2::maxValue();
        if ($value1 == 1) {

            return RgbComponent::maxValue();
        }
        if ($value2 == 0) {

            return 0;
        }

        return (1 - min(1, (1 - $value1) / $value2)) * RgbComponent::maxValue();
    }
}
