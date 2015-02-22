<?php

namespace Rainbow\Unit;

final class Percent
{
    private $value;

    public function __construct($value = 0)
    {
        $intValue = (int) $value;
        if ($this->isOutOfBounds($intValue)) {
            throw new \OutOfBoundsException(sprintf("Incorrect percent value %s", $value));
        }
        $this->value = $intValue;
    }

    private function isOutOfBounds($value)
    {
        return ($value < 0) || ($value > 100);
    }

    public function getValue()
    {
        return $this->value;
    }
}
