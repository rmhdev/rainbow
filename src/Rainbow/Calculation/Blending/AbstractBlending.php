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
        $red = $this->blend(
            $color1->getRed()->getValue() / Rgb::maxValue(),
            $color2->getRed()->getValue() / Rgb::maxValue()
        );
        $green = $this->blend(
            $color1->getGreen()->getValue() / Rgb::maxValue(),
            $color2->getGreen()->getValue() / Rgb::maxValue()
        );
        $blue = $this->blend(
            $color1->getBlue()->getValue() / Rgb::maxValue(),
            $color2->getBlue()->getValue() / Rgb::maxValue()
        );

        $this->result = new Rgba(
            $red * Rgb::maxValue(),
            $green * Rgb::maxValue(),
            $blue * Rgb::maxValue(),
            1
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
    protected function multiply($backdrop, $source)
    {
        return $backdrop * $source;
    }

    /**
     * @param float $backdrop
     * @param float $source
     * @return float
     */
    protected function screen($backdrop, $source)
    {
        return $backdrop + $source - ($this->multiply($backdrop, $source));
    }

    /**
     * @return Rgba
     */
    public function result()
    {
        return $this->result->copy();
    }
}
