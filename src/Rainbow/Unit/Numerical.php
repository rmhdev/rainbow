<?php

namespace Rainbow\Unit;

final class Numerical
{
    const MAX_INT = 255;

    private $value;

    public function __construct($value = 0)
    {
        $value = (int) $value;
        if ($this->isOutOfBoundsValue($value)) {
            throw new \OutOfBoundsException(sprintf("Incorrect value %s", $value));
        }
        $this->value = $value;
    }

    private function isOutOfBoundsValue($value)
    {
        return ($value < 0) || ($value > self::MAX_INT);
    }

    public function getInt()
    {
        return $this->value;
    }
}
