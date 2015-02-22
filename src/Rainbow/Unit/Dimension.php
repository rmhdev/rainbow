<?php

namespace Rainbow\Unit;

final class Dimension implements UnitInterface
{
    const MAX_INT = 255;

    private $value;

    public function __construct($value = 0)
    {
        $value = trim($value);
        if (!is_numeric($value)) {
            throw new \UnexpectedValueException();
        }
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
        return (string) $this->getValue();
    }
}
