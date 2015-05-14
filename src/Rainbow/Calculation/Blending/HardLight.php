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
use Rainbow\Rgb;

/**
 * Class HardLight
 * @package Rainbow\Calculation\Blending
 * @link http://www.w3.org/TR/compositing-1/#valdef-blend-mode-hard-light
 */
final class HardLight implements CalculationInterface
{
    /**
     * @var Rgb
     */
    private $color;

    /**
     * @param Rgb $color1
     * @param Rgb $color2
     */
    public function __construct(Rgb $color1, Rgb $color2)
    {
        $overlay = new Overlay($color2, $color1);
        $this->color = $overlay->result();
    }

    /**
     * @return Rgb
     */
    public function result()
    {
        return $this->color->copy();
    }
}
