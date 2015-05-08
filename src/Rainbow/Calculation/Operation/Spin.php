<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Calculation\Operation;

use Rainbow\Calculation\CalculationInterface;
use Rainbow\Hsl;
use Rainbow\Unit\Angle;

final class Spin implements CalculationInterface
{
    private $value;

    /**
     * @param Hsl $color
     * @param int $difference
     */
    public function __construct(Hsl $color, $difference = 0)
    {
        $this->value = $this->calculateNewAngleValue($color->getHue(), $difference);
    }

    private function calculateNewAngleValue(Angle $angle, $difference)
    {
        return $angle->getValue() + $difference;
    }

    /**
     * @return Angle
     */
    public function result()
    {
        return new Angle($this->value);
    }
}
