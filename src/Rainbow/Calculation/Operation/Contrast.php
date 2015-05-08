<?php

namespace Rainbow\Calculation\Operation;

use Rainbow\Calculation\CalculationInterface;
use Rainbow\Rgb;

final class Contrast implements CalculationInterface
{
    public function result()
    {
        return new Rgb();
    }

}
