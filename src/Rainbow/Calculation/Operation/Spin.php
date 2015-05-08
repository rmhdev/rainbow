<?php

namespace Rainbow\Calculation\Operation;

use Rainbow\Calculation\CalculationInterface;
use Rainbow\Hsl;
use Rainbow\Unit\Angle;

final class Spin implements CalculationInterface
{
    private $value;

    public function __construct(Hsl $color, $difference)
    {
        $this->value = $this->calculateNewAngleValue($color->getHue(), $difference);
    }

    private function calculateNewAngleValue(Angle $angle, $difference)
    {
        return $angle->getValue() + $difference;
    }

    public function result()
    {
        return new Angle($this->value);
    }
}
