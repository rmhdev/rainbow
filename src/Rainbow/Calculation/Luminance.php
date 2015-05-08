<?php

namespace Rainbow\Calculation;

use Rainbow\Rgb;
use Rainbow\Unit\Component;
use Rainbow\Unit\Percent;

final class Luminance
{
    private $value;

    public function __construct(Rgb $color)
    {
        $this->value = $this->calculateValue($color);
    }

    private function calculateValue(Rgb $color)
    {
        $red = $color->getRed()->getValue() / Component::MAX_VALUE;
        $green = $color->getGreen()->getValue() / Component::MAX_VALUE;
        $blue = $color->getBlue()->getValue() / Component::MAX_VALUE;

        $red    = ($red <= 0.03928)     ? $red / 12.92 : (($red + 0.055) / 1.055) ** 2.4;
        $green  = ($green <= 0.03928)   ? $green / 12.92 : (($green + 0.055) / 1.055) ** 2.4;
        $blue   = ($blue <= 0.03928)    ? $blue / 12.92 : (($blue + 0.055) / 1.055) ** 2.4;

        $value = 0.2126 * $red + 0.7152 * $green + 0.0722 * $blue;

        return $value * 100;
    }

    public function value()
    {
        return new Percent($this->value);
    }
}
