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
use Rainbow\Unit\RgbComponent;

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
        $red = $this->blend($color1->getRed(), $color2->getRed());
        $green = $this->blend($color1->getGreen(), $color2->getGreen());
        $blue = $this->blend($color1->getBlue(), $color2->getBlue());

        $this->result = new Rgba($red, $green, $blue, 1);
    }

    /**
     * @param RgbComponent $component1
     * @param RgbComponent $component2
     * @return int
     */
    abstract protected function blend(RgbComponent $component1, RgbComponent $component2);

    /**
     * @param int|RgbComponent $component1
     * @param int|RgbComponent $component2
     * @return float
     */
    protected function multiply($component1, $component2)
    {
        if ($component1 instanceof RgbComponent) {
            $component1 = $component1->getValue();
        }
        if ($component2 instanceof RgbComponent) {
            $component2 = $component2->getValue();
        }

        return $component1 * $component2 / RgbComponent::MAX_VALUE;
    }

    /**
     * @param int|RgbComponent $component1
     * @param int|RgbComponent $component2
     * @return float
     */
    protected function screen($component1, $component2)
    {
        if ($component1 instanceof RgbComponent) {
            $component1 = $component1->getValue();
        }
        if ($component2 instanceof RgbComponent) {
            $component2 = $component2->getValue();
        }

        return $component1 + $component2 - ($this->multiply($component1, $component2));
    }

    /**
     * @return Rgba
     */
    public function result()
    {
        return $this->result->copy();
    }
}
