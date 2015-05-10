<?php

namespace Rainbow\Calculation\Channel;

use Rainbow\Rgb;
use Rainbow\Unit\Percent;
use Rainbow\Unit\RgbComponent;

final class Luminance
{
    private $value;

    public function __construct(Rgb $color)
    {
        $this->value = $this->calculateLuminance($color);
    }

    private function calculateLuminance(Rgb $color)
    {
        $red    = $color->getRed()->getValue() / RgbComponent::MAX_VALUE;
        $green  = $color->getGreen()->getValue() / RgbComponent::MAX_VALUE;
        $blue   = $color->getBlue()->getValue() / RgbComponent::MAX_VALUE;

        $value = 0.2126 * $red + 0.7152 * $green + 0.0722 * $blue;

        return $value * 100;
    }

    public function result()
    {
        return new Percent($this->value);
    }
}
