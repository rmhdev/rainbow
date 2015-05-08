<?php

namespace Rainbow\Calculation\Operation;

use Rainbow\Calculation\CalculationInterface;
use Rainbow\Rgb;

final class Contrast implements CalculationInterface
{
    private $contrast;

    public function __construct(Rgb $color)
    {
        $this->contrast = $this->calculateContrast($color);
    }

    private function calculateContrast(Rgb $color)
    {
        return $color->getRed()->getValue() ? new Rgb(0, 0, 0) : new Rgb(255, 255, 255);
    }

    public function result()
    {
        return $this->contrast->copy();
    }

}
