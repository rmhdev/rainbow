<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Component;

final class Hex implements ComponentInterface
{
    /**
     * @var Rgb
     */
    private $rgb;

    /**
     * @param number|string $value
     */
    public function __construct($value = null)
    {
        $this->rgb = new Rgb(
            hexdec($this->processValue($value))
        );
    }

    private function processValue($value = null)
    {
        if (is_null($value)) {
            $value = 0;
        }
        if ($this->isOutOfBounds($value)) {
            throw new \OutOfBoundsException(
                sprintf('Hex value %s must be between 0 and %s', $value, Rgb::MAX_VALUE)
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
        if (Rgb::MAX_VALUE < $number) {
            return true;
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function getValue()
    {
        return $this->rgb->getValue();
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        $string = (string)dechex($this->getValue());
        if (strlen($string) == 1) {
            $string .= $string;
        }

        return $string;
    }
}
