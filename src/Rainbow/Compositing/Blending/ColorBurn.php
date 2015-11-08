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
 * Darkens the backdrop color to reflect the source color
 * @link http://www.w3.org/TR/compositing-1/#blendingcolorburn
 */
final class ColorBurn extends AbstractBlending implements BlendingInterface
{
    /**
     * {@inheritDoc}
     */
    protected function blend($backdrop, $source)
    {
        if ($backdrop == 1) {

            return 1;
        }
        if ($source == 0) {

            return 0;
        }

        return 1 - min(1, (1 - $backdrop) / $source);
    }
}
