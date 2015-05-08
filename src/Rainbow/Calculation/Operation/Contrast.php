<?php

namespace Rainbow\Calculation\Operation;

use Rainbow\Calculation\CalculationInterface;
use Rainbow\Rgb;

final class Contrast implements CalculationInterface
{
    private $contrast;

    public function __construct(Rgb $color, Rgb $dark = null, Rgb $light = null)
    {
        if (!$dark) {
            $dark = new Rgb(0, 0, 0);
        }
        if (!$light) {
            $light = new Rgb(255, 255, 255);
        }
        $this->contrast = $this->calculateContrast($color, $dark, $light);
    }

    private function calculateContrast(Rgb $color, Rgb $dark, Rgb $light)
    {
        return $color->getRed()->getValue() ? $dark : $light;
    }

    public function result()
    {
        return $this->contrast->copy();
    }

}
