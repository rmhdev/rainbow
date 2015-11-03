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

abstract class AbstractBlending implements BlendingInterface
{
    /**
     * @var Rgba
     */
    private $result;

    /**
     * @param Rgba $backdrop
     * @param Rgba $source
     */
    public function __construct(Rgba $backdrop, Rgba $source)
    {
        $this->result = new Rgba(
            $this->blendRed($backdrop, $source) * Rgb::MAX_VALUE,
            $this->blendGreen($backdrop, $source) * Rgb::MAX_VALUE,
            $this->blendBlue($backdrop, $source) * Rgb::MAX_VALUE,
            1
        );
    }

    private function blendRed(Rgba $backdrop, Rgba $source)
    {
        return $this->blend(
            $backdrop->getRed()->getValue() / Rgb::MAX_VALUE,
            $source->getRed()->getValue() / Rgb::MAX_VALUE
        );
    }

    private function blendGreen(Rgba $backdrop, Rgba $source)
    {
        return $this->blend(
            $backdrop->getGreen()->getValue() / Rgb::MAX_VALUE,
            $source->getGreen()->getValue() / Rgb::MAX_VALUE
        );
    }

    private function blendBlue(Rgba $backdrop, Rgba $source)
    {
        return $this->blend(
            $backdrop->getBlue()->getValue() / Rgb::MAX_VALUE,
            $source->getBlue()->getValue() / Rgb::MAX_VALUE
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
