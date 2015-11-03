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
    protected function blend($backdrop, $source)
    {
        if ($backdrop == 0) {
            return 0;
        }
        if ($source == 1) {
            return 1;
        }

        return min(1, $backdrop / (1 - $source));
    }
}
