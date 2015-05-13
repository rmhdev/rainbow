<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Calculation\Blending;

use Rainbow\Rgb;
use Rainbow\Unit\RgbComponent;

class Overlay
{
    private $result;

    public function __construct(Rgb $color1, Rgb $color2)
    {
        $red = $this->calculateComponentValue($color1->getRed(), $color2->getRed());
        $green = $this->calculateComponentValue($color1->getGreen(), $color2->getGreen());
        $blue = $this->calculateComponentValue($color1->getBlue(), $color2->getBlue());

        $this->result = new Rgb($red, $green, $blue);
    }

    private function calculateComponentValue(RgbComponent $component1, RgbComponent $component2)
    {
        $max = RgbComponent::MAX_VALUE;
        if ($component1->getValue() <= ceil(RgbComponent::MAX_VALUE / 2)) {
            return 2 * $component1->getValue() * $component2->getValue() / $max;
        }

        return $max - 2 * ($max - $component1->getValue()) * ($max - $component2->getValue()) / $max;
    }

    public function result()
    {
        return $this->result->copy();
    }
}