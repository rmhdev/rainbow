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
use Rainbow\Unit\Percent;

final class Saturation extends AbstractOperation implements CalculationInterface
{
    private $saturation;

    /**
     * @param Hsl $color
     * @param int $difference
     */
    public function __construct(Hsl $color, $difference = 0)
    {
        $this->saturation = $this->calculatePercentValue(
            $color->getSaturation(),
            $difference
        );
    }

    /**
     * @return Percent
     */
    public function result()
    {
        return new Percent($this->saturation);
    }
}
