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
 * Darkens or lightens the colors, depending on the source color value
 * @link http://www.w3.org/TR/compositing-1/#blendingsoftlight
 */
final class SoftLight extends AbstractBlending implements BlendingInterface
{
    /**
     * {@inheritDoc}
     */
    protected function blend($backdrop, $source)
    {
        $d = 1;
        $e = $backdrop;
        if ($source > 0.5) {
            $e = 1;
            $d = ($backdrop > 0.25) ?
                sqrt($backdrop) :
                ((16 * $backdrop - 12) * $backdrop + 4) * $backdrop;
        }
        $result = $backdrop - (1 - 2 * $source) * $e * ($d - $backdrop);

        return $result;
    }
}
