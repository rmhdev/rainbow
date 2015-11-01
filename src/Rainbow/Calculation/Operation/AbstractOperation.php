<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Calculation\Operation;

use Rainbow\Component\Percent;

abstract class AbstractOperation
{
    /**
     * @param Percent $value
     * @param int $difference
     * @return int
     */
    protected function calculatePercentValue(Percent $value, $difference)
    {
        $value = $value->getValue();
        if (!$difference) {
            return $value;
        }
        if ($difference < 0) {
            return max($value + $difference, 0);
        }

        return min($value + $difference, 100);
    }
}
