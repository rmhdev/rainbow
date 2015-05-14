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
 * Subtracts the darker of the two constituent colors from the lighter color
 * @package Rainbow\Calculation\Blending
 * @link http://www.w3.org/TR/compositing-1/#valdef-blend-mode-difference
 */
final class Difference extends AbstractBlending implements CalculationInterface
{
    /**
     * {@inheritDoc}
     */
    protected function calculateComponentValue(RgbComponent $component1, RgbComponent $component2)
    {
        return abs($component1->getValue() - $component2->getValue());
    }
}
