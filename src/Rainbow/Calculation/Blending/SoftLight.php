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
 * Class SoftLight
 * @package Rainbow\Calculation\Blending
 * @link http://www.w3.org/TR/compositing-1/#blendingsoftlight
 */
final class SoftLight extends AbstractBlending implements CalculationInterface
{
    /**
     * @param RgbComponent $component1
     * @param RgbComponent $component2
     * @return int
     */
    protected function calculateComponentValue(RgbComponent $component1, RgbComponent $component2)
    {
        $color1 = $component1->getValue();
        $color2 = $component2->getValue();
        $max    = RgbComponent::MAX_VALUE;
        $t      = $color2 * $color1 / $max;

        return  $t + $color1 * ($max - ($max - $color1) * ($max - $color2) / $max - $t) / $max;
    }
}
