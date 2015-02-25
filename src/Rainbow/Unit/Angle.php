<?php

namespace Rainbow\Unit;

final class Angle
{
    private $value;

    public function __construct($value = 0)
    {
        $number = (int) $value;
        $this->value = (($number % 360) + 360) % 360;
    }

    public function getValue()
    {
        return $this->value;
    }
}
