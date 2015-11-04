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
 * The source color is multiplied by the destination color and replaces the destination
 * @link http://www.w3.org/TR/compositing-1/#blendingmultiply
 */
final class Multiply extends AbstractBlending implements BlendingInterface
{
    /**
     * {@inheritDoc}
     */
    protected function blend($backdrop, $source)
    {
        return $backdrop * $source;
    }
}
