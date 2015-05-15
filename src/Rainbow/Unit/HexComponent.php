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
        if ($this->isOutOfBounds($value)) {
            throw new \OutOfBoundsException(
                sprintf('Hex value %s must be between 0 and %s', $value, dechex(RgbComponent::MAX_VALUE))
            );
        }
        $result = $this->valueToString($value);
        if (1 === strlen($result)) {
            $result .= $result;
        }

        return $result;
    }

    private function valueToString($value = "")
    {
        return dechex(hexdec($value));
    }

    private function isOutOfBounds($rawValue)
    {
        if (is_numeric($rawValue) && (0 > $rawValue)) {
            return true;
        }
        $number = hexdec($rawValue);
        if (RgbComponent::MAX_VALUE < $number) {
            return true;
        }

        return false;
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
