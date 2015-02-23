<?php

namespace Rainbow\Unit;

final class Component implements UnitInterface
{
    const MAX_INT = 255;

    private $value;

    /**
     * @param int|string $value
     */
    public function __construct($value = 0)
    {
        $number = $this->formatNumber($value);
        if ($this->isOutOfBoundsValue($number)) {
            throw new \OutOfBoundsException(sprintf("Incorrect value %s", $value));
        }
        $this->value = $number;
    }

    private function formatNumber($value)
    {
        $value = trim($value);
        if ("%" === substr($value, -1, 1)) {
            $percent = intval($value, 10);
            $value = ($percent * self::MAX_INT) / 100;
        }
        if (!is_numeric($value)) {
            throw new \UnexpectedValueException(sprintf("Incorrect component %s", $value));
        }

        return (int) $value;
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
