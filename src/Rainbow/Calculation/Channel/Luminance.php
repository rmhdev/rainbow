<?php

namespace Rainbow\Calculation\Channel;

use Rainbow\Rgb;
use Rainbow\Unit\Percent;

final class Luminance
{
    private $value;

    public function __construct(Rgb $color)
    {
        $this->value = $this->calculateLuminance($color);
    }

    private function calculateLuminance(Rgb $color)
    {
        return $color->getRed()->getValue() ? 100 : 0;
    }

    public function result()
    {
        return new Percent($this->value);
    }
}
