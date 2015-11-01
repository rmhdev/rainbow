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
use Rainbow\Component\Rgb;

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
    protected function blend(Rgb $value1, Rgb $value2)
    {
        $value1 = $value1->getValue() / Rgb::maxValue();
        $value2 = $value2->getValue() / Rgb::maxValue();
        if ($value1 == 0) {
            return 0;
        }
        if ($value2 == 1) {
            return Rgb::maxValue();
        }

        return min(1, $value1 / (1 - $value2)) * Rgb::maxValue();
    }
}
