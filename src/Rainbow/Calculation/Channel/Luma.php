<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Calculation\Channel;

use Rainbow\Calculation\CalculationInterface;
use Rainbow\Rgb;
use Rainbow\Unit\RgbComponent;
use Rainbow\Unit\Percent;

final class Luma implements CalculationInterface
{
    private $value;

    /**
     * @param Rgb $color
     */
    public function __construct(Rgb $color)
    {
        $this->value = $this->calculateValue($color);
    }

    private function calculateValue(Rgb $color)
    {
        $red    = $this->calculateComponent($color->getRed()->getValue());
        $green  = $this->calculateComponent($color->getGreen()->getValue());
        $blue   = $this->calculateComponent($color->getBlue()->getValue());

        $value = 0.2126 * $red + 0.7152 * $green + 0.0722 * $blue;

        return $value * 100;
    }

    /**
     * @param int $component  value from 0 to 255
     * @return float
     */
    private function calculateComponent($component = 0)
    {
        $component /= RgbComponent::MAX_VALUE;

        return ($component <= 0.03928) ? $component / 12.92 : (($component + 0.055) / 1.055) ** 2.4;
    }

    /**
     * @return Percent
     */
    public function result()
    {
        return new Percent($this->value);
    }
}
