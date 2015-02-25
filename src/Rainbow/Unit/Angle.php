<?php

namespace Rainbow\Unit;

final class Angle
{
    private $value;

    public function __construct($value = 0)
    {
        $this->value = (int) $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}
