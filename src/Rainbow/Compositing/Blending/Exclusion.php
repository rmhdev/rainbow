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
 * Produces an effect similar to that of the Difference mode but lower in contrast
 * @link http://www.w3.org/TR/compositing-1/#blendingexclusion
 */
final class Exclusion extends AbstractBlending implements BlendingInterface
{
    /**
     * {@inheritDoc}
     */
    protected function blend($backdrop, $source)
    {
        $sum = $backdrop + $source;
        $prod = 2 * ($backdrop * $source);

        return $sum - $prod;
    }
}
