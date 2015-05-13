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
use Rainbow\Unit\RgbComponent;

final class Screen implements CalculationInterface
{
    /**
     * @var Rgb
     */
    private $result;

    /**
     * @param Rgb $color1
     * @param Rgb $color2
     */
    public function __construct(Rgb $color1, Rgb $color2)
    {
        $red = $this->calculateComponentValue($color1->getRed(), $color2->getRed());
        $green = $this->calculateComponentValue($color1->getGreen(), $color2->getGreen());
        $blue = $this->calculateComponentValue($color1->getBlue(), $color2->getBlue());

        $this->result = new Rgb($red, $green, $blue);
    }



    private function calculateComponentValue(RgbComponent $component1, RgbComponent $component2)
    {
        return $component1->getValue() + $component2->getValue() - ($this->multiply($component1, $component2));
    }

    protected function multiply(RgbComponent $component1, RgbComponent $component2)
    {
        return $component1->getValue() * $component2->getValue() / RgbComponent::MAX_VALUE;
    }

    /**
     * @return Rgb
     */
    public function result()
    {
        return $this->result->copy();
    }
}
