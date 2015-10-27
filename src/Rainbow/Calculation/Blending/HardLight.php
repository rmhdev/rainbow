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
use Rainbow\Rgba;

/**
 * Class HardLight
 * @package Rainbow\Calculation\Blending
 * @link http://www.w3.org/TR/compositing-1/#valdef-blend-mode-hard-light
 */
final class HardLight implements CalculationInterface
{
    /**
     * @var Rgba
     */
    private $color;

    /**
     * @param Rgba $color1
     * @param Rgba $color2
     */
    public function __construct(Rgba $color1, Rgba $color2)
    {
        $overlay = new Overlay($color2, $color1);
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
