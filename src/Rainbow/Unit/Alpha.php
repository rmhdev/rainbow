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
        if ($this->isNotANumber($value)) {
            throw new \UnexpectedValueException(sprintf("Incorrect alpha value %s", $value));
        }
        $number = $this->toNumber($value);
        if ($this->isOutOfBounds($number)) {
            throw new \OutOfBoundsException(sprintf("Incorrect alpha value %s", $value));
        }
        $this->value = $number;
    }

    private function isNotANumber($value)
    {
        $value = trim($value);

        return !is_numeric($value);
    }

    private function toNumber($value)
    {
        return floor(floatval($value) * 10) / 10;
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
