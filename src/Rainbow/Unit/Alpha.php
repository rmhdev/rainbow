<?php

namespace Rainbow\Unit;

final class Alpha
{
    private $value;

    public function __construct($value = 1)
    {
        $this->setValue($value);
    }

    private function setValue($value)
    {
        $number = (float) $value;
        if ($this->isOutOfBounds($number)) {
            throw new \OutOfBoundsException(sprintf("Incorrect value", $value));
        }
        $this->value = $number;
    }

    private function isOutOfBounds($value)
    {
        return ($value < 0) || ($value > 1);
    }

    public function getValue()
    {
        return $this->value;
    }
}
