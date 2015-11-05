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
use Rainbow\Component\Rgb as RgbComponent;

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
            $this->blendRed($backdrop, $source) * RgbComponent::MAX_VALUE,
            $this->blendGreen($backdrop, $source) * RgbComponent::MAX_VALUE,
            $this->blendBlue($backdrop, $source) * RgbComponent::MAX_VALUE,
            $this->blendAlpha($backdrop, $source) * Alpha::MAX_VALUE
        );
    }

    private function blendRed(Rgba $backdrop, Rgba $source)
    {
        return $this->blend(
            $backdrop->getRed()->getValue() / RgbComponent::MAX_VALUE,
            $source->getRed()->getValue() / RgbComponent::MAX_VALUE
        );
    }

    private function blendGreen(Rgba $backdrop, Rgba $source)
    {
        return $this->blend(
            $backdrop->getGreen()->getValue() / RgbComponent::MAX_VALUE,
            $source->getGreen()->getValue() / RgbComponent::MAX_VALUE
        );
    }

    private function blendBlue(Rgba $backdrop, Rgba $source)
    {
        return $this->blend(
            $backdrop->getBlue()->getValue() / RgbComponent::MAX_VALUE,
            $source->getBlue()->getValue() / RgbComponent::MAX_VALUE
        );
    }

    protected function blendAlpha(Rgba $backdrop, Rgba $source)
    {
        return 1;
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
