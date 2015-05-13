<?php

namespace Rainbow\Calculation\Blending;

use Rainbow\Calculation\CalculationInterface;
use Rainbow\Rgb;
use Rainbow\Unit\RgbComponent;

final class Multiply implements CalculationInterface
{
    private $result;

    /**
     * @param Rgb $colorA
     * @param Rgb $colorB
     */
    public function __construct(Rgb $colorA, Rgb $colorB)
    {
        $red = $this->calculateComponentValue($colorA->getRed(), $colorB->getRed());
        $green = $this->calculateComponentValue($colorA->getGreen(), $colorB->getGreen());
        $blue = $this->calculateComponentValue($colorA->getBlue(), $colorB->getBlue());

        $this->result = new Rgb($red, $green, $blue);
    }

    private function calculateComponentValue(RgbComponent $component1, RgbComponent $component2)
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
