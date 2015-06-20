<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Unit;

final class Alpha implements UnitInterface
{
    private $value;

    /**
     * @param int|number $value
     */
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
        return ($value < 0) || ($value > 1);
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
