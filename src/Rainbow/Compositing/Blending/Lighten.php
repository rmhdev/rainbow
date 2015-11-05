<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Compositing\Blending;

use Rainbow\Component\Alpha;
use Rainbow\Rgba;

/**
 * Selects the lighter of the backdrop and source colors
 * @link http://www.w3.org/TR/compositing-1/#blendinglighten
 */
final class Lighten extends AbstractBlending implements BlendingInterface
{
    /**
     * {@inheritDoc}
     */
    protected function blend($backdrop, $source)
    {
        return max($backdrop, $source);
    }

    protected function blendAlpha(Rgba $backdrop, Rgba $source)
    {
        return $this->blend(
            $backdrop->getAlpha()->getValue() / Alpha::MAX_VALUE,
            $source->getAlpha()->getValue() / Alpha::MAX_VALUE
        );
    }
}
