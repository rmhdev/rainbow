<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Compositing\Blending;

/**
 * Brightens the backdrop color to reflect the source color
 * @link http://www.w3.org/TR/compositing-1/#blendingcolordodge
 */
final class ColorDodge extends AbstractBlending implements BlendingInterface
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
