<?php

namespace Rainbow\Calculation\Blending;

use Rainbow\Rgb;

final class Multiply
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
        return $colorA;
    }

    /**
     * @return Rgb
     */
    public function result()
    {
        return $this->result->copy();
    }
}
