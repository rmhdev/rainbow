<?php

namespace Rainbow\Component;

final class Component implements ComponentInterface
{
    const MAX_VALUE = 1;

    private $value;

    /**
     * @param int|number $value
     */
    public function __construct($value = self::MAX_VALUE)
    {
        $this->setValue($value);
    }

    private function setValue($value)
    {
        if ($this->isNotANumber($value)) {
            throw new \UnexpectedValueException(sprintf("Incorrect component value %s", $value));
        }
        if ($this->isOutOfBounds($value)) {
            throw new \OutOfBoundsException(sprintf("Incorrect component value %s", $value));
        }
        $this->value = $this->formatNumber($value);
    }

    private function isNotANumber($value)
    {
        return !is_numeric(trim($value));
    }

    private function formatNumber($value)
    {
        return round(floatval($value) * 100) / 100;
    }

    private function isOutOfBounds($value)
    {
        return ($value < 0) || ($value > self::MAX_VALUE);
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

    /**
     * {@inheritDoc}
     * @return float
     */
    public static function maxValue()
    {
        return self::MAX_VALUE;
    }
}
