<?php

namespace Rainbow\Calculation\Operation;

use Rainbow\Calculation\CalculationInterface;
use Rainbow\Rgb;

final class Contrast implements CalculationInterface
{
    private $contrast;

    public function __construct(Rgb $color, Rgb $dark = null)
    {
        if (!$dark) {
            $dark = new Rgb(0, 0, 0);
        }
        $this->contrast = $this->calculateContrast($color, $dark);
    }

    private function calculateContrast(Rgb $color, Rgb $dark)
    {
        return $color->getRed()->getValue() ? $dark : new Rgb(255, 255, 255);
    }

    public function result()
    {
        return $this->contrast->copy();
    }

}
