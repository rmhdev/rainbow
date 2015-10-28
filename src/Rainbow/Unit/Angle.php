<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Unit;

final class Angle implements UnitInterface
{
    const MAX_VALUE = 360;

    private $value;

    /**
     * @param int|string $value
     */
    public function __construct($value = 0)
    {
        $number = $this->toNumber($value);
        $this->value = (($number % self::MAX_VALUE) + self::MAX_VALUE) % self::MAX_VALUE;
    }

    private function toNumber($value)
    {
        if (!is_numeric(trim($value))) {
            throw new \UnexpectedValueException(sprintf("Incorrect angle %s", $value));
        }
        if ((int)$value != $value) {
            $value = round($value);
        }

        return (int)$value;
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
     * @return int
     */
    public static function maxValue()
    {
        return self::MAX_VALUE;
    }
}
