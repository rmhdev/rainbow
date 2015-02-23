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
        if ($this->isOutOfBounds($value)) {
            throw new \OutOfBoundsException(sprintf("Incorrect alpha value %s", $value));
        }
        $this->value = $this->toNumber($value);
    }

    private function isNotANumber($value)
    {
        return !is_numeric(trim($value));
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

    public function __toString()
    {
        return (string) $this->getValue();
    }
}
