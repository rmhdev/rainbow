<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Compositing\Blending;

use Rainbow\Rgba;

/**
 * Class HardLight
 * @package Rainbow\Calculation\Blending
 * @link http://www.w3.org/TR/compositing-1/#valdef-blend-mode-hard-light
 */
final class HardLight implements BlendingInterface
{
    /**
     * @var Rgba
     */
    private $color;

    /**
     * @param Rgba $backdrop
     * @param Rgba $source
     */
    public function __construct(Rgba $backdrop, Rgba $source)
    {
        $overlay = new Overlay($source, $backdrop);
        $this->color = $overlay->result();
    }

    /**
     * @return Rgba
     */
    public function result()
    {
        return $this->color->copy();
    }
}
