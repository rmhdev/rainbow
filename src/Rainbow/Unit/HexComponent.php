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
        $value = strtolower($value);
        if (1 === strlen($value)) {
            $value .= $value;
        }

        return $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}
