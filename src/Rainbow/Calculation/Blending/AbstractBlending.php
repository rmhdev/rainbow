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
            $color1->getRed()->getValue() / Rgb::MAX_VALUE,
            $color2->getRed()->getValue() / Rgb::MAX_VALUE
        );
        $green = $this->blend(
            $color1->getGreen()->getValue() / Rgb::MAX_VALUE,
            $color2->getGreen()->getValue() / Rgb::MAX_VALUE
        );
        $blue = $this->blend(
            $color1->getBlue()->getValue() / Rgb::MAX_VALUE,
            $color2->getBlue()->getValue() / Rgb::MAX_VALUE
        );

        $this->result = new Rgba(
            $red * Rgb::MAX_VALUE,
            $green * Rgb::MAX_VALUE,
            $blue * Rgb::MAX_VALUE,
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
