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
 * Multiplies or screens the colors, depending on the backdrop color value.
 * @link http://www.w3.org/TR/compositing-1/#blendingoverlay
 */
class Overlay extends AbstractBlending implements BlendingInterface
{
    /**
     * {@inheritDoc}
     */
    protected function blend($backdrop, $source)
    {
        $value1 = 2 * $backdrop;
        if ($value1 <= 1) {

            return $value1 * $source;
        }

        return $this->screen($value1 - 1, $source);
    }

    protected function blendAlpha(Rgba $backdrop, Rgba $source)
    {
        return $this->blend(
            $backdrop->getAlpha()->getValue() / Alpha::MAX_VALUE,
            $source->getAlpha()->getValue() / Alpha::MAX_VALUE
        );
    }
}
