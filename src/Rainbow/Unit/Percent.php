<?php

namespace Rainbow\Unit;

final class Percent implements UnitInterface
{
    private $value;

    /**
     * @param int|string $value
     */
    public function __construct($value = 0)
    {
        $number = $this->toNumber($value);
        if ($this->isOutOfBounds($number)) {
            throw new \OutOfBoundsException(sprintf("Incorrect percent value %s", $value));
        }
        $this->value = $number;
    }

    private function toNumber($value)
    {
        $processed = trim($value);
        if ("%" === substr($processed, -1, 1)) {
            $processed = substr($processed, 0, strlen($processed) - 1);
        }
        if (!is_numeric($processed)) {
            throw new \UnexpectedValueException(sprintf("Incorrect value %s", $value));
        }

        return (int) $processed;
    }

    private function isOutOfBounds($value)
    {
        return ($value < 0) || ($value > 100);
    }

    /**
     * {@inheritDoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return sprintf("%s%%", $this->getValue());
    }
}
