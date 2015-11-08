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
 * Selects the darker of the backdrop and source colors
 * @link http://www.w3.org/TR/compositing-1/#blendingdarken
 */
final class Darken extends AbstractBlending implements BlendingInterface
{
    /**
     * {@inheritDoc}
     */
    protected function blend($backdrop, $source)
    {
        return min($backdrop, $source);
    }
}
