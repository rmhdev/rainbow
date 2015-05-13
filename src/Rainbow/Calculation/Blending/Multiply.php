<?php

namespace Rainbow\Calculation\Blending;

use Rainbow\Calculation\CalculationInterface;
use Rainbow\Rgb;

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
        $red = $colorA->getRed()->multiply($colorB->getRed())->getValue();
        $green = $colorA->getGreen()->multiply($colorB->getGreen())->getValue();
        $blue = $colorA->getBlue()->multiply($colorB->getBlue())->getValue();

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
