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
        $this->result = $this->calculateResult($colorA, $colorB);
    }

    /**
     * @param Rgb $colorA
     * @param Rgb $colorB
     * @return Rgb
     */
    private function calculateResult(Rgb $colorA, Rgb $colorB)
    {
        $red = ($colorA->getRed()->getValue() * $colorB->getRed()->getValue()) / RgbComponent::MAX_VALUE;
        $green = ($colorA->getGreen()->getValue() * $colorB->getGreen()->getValue()) / RgbComponent::MAX_VALUE;
        $blue = ($colorA->getBlue()->getValue() * $colorB->getBlue()->getValue()) / RgbComponent::MAX_VALUE;

        return new Rgb($red, $green, $blue);
    }

    /**
     * @return Rgb
     */
    public function result()
    {
        return $this->result->copy();
    }
}
