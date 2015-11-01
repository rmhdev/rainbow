<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Component;

final class Percent implements ComponentInterface
{
    const MAX_VALUE = 100;

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
        if (((int)$processed) != $processed) {
            $processed = round($processed);
        }

        return (int) $processed;
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
        return sprintf("%s%%", $this->getValue());
    }

    /**
     * {@inheritDoc}
     * @return int
     */
    public static function maxValue()
    {
        return self::MAX_VALUE;
    }
}
