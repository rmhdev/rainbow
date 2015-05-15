<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Unit;

final class HexComponent
{
    /**
     * @var string
     */
    private $value;

    public function __construct($value = null)
    {
        $this->value = $this->processValue($value);
    }

    private function processValue($value = null)
    {
        if (is_null($value)) {
            $value = 0;
        }
        $processed = strtolower($value);
        if (1 === strlen($processed)) {
            $processed .= $processed;
        }
        if ($this->isOutOfBounds($processed)) {
            throw new \OutOfBoundsException(
                sprintf('Hex value %s must be between 0 and %s', $value, dechex(RgbComponent::MAX_VALUE))
            );
        }

        return $processed;
    }

    private function isOutOfBounds($value = "")
    {
        if (is_numeric($value) && (0 > $value)) {
            return true;
        }
        $number = hexdec($value);

        return RgbComponent::MAX_VALUE < $number;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function __toString()
    {
        return (string)$this->getValue();
    }
}
