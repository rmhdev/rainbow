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
    private $value;

    /**
     * @param int|string $value
     */
    public function __construct($value = 0)
    {
        $number = $this->toNumber($value);
        $this->value = (($number % 360) + 360) % 360;
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
}
