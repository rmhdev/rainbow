<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Calculation\Blending;

use Rainbow\Rgba;
use Rainbow\Component\Rgb;

abstract class AbstractBlending
{
    /**
     * @var Rgba
     */
    private $result;

    /**
     * @param Rgba $color1
     * @param Rgba $color2
     */
    public function __construct(Rgba $color1, Rgba $color2)
    {
        $this->result = new Rgba(
            $this->blendRed($color1, $color2) * Rgb::MAX_VALUE,
            $this->blendGreen($color1, $color2) * Rgb::MAX_VALUE,
            $this->blendBlue($color1, $color2) * Rgb::MAX_VALUE,
            1
        );
    }

    private function blendRed(Rgba $color1, Rgba $color2)
    {
        return $this->blend(
            $color1->getRed()->getValue() / Rgb::MAX_VALUE,
            $color2->getRed()->getValue() / Rgb::MAX_VALUE
        );
    }

    private function blendGreen(Rgba $color1, Rgba $color2)
    {
        return $this->blend(
            $color1->getGreen()->getValue() / Rgb::MAX_VALUE,
            $color2->getGreen()->getValue() / Rgb::MAX_VALUE
        );
    }

    private function blendBlue(Rgba $color1, Rgba $color2)
    {
        return $this->blend(
            $color1->getBlue()->getValue() / Rgb::MAX_VALUE,
            $color2->getBlue()->getValue() / Rgb::MAX_VALUE
        );
    }

    /**
     * @param float $backdrop
     * @param float $source
     * @return float
     */
    abstract protected function blend($backdrop, $source);

    /**
     * @param float $backdrop
     * @param float $source
     * @return float
     */
    protected function screen($backdrop, $source)
    {
        return $backdrop + $source - ($backdrop * $source);
    }

    /**
     * @return Rgba
     */
    public function result()
    {
        return $this->result->copy();
    }
}
