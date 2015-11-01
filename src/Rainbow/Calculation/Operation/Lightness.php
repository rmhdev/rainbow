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
use Rainbow\Component\Percent;

final class Lightness extends AbstractOperation implements CalculationInterface
{
    private $lightness;

    /**
     * @param Hsl $color
     * @param int $difference
     */
    public function __construct(Hsl $color, $difference = 0)
    {
        $this->lightness = $this->calculatePercentValue(
            $color->getLightness(),
            $difference
        );
    }

    /**
     * @return Percent
     */
    public function result()
    {
        return new Percent($this->lightness);
    }
}
