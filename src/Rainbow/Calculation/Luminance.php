<?php

namespace Rainbow\Calculation;

use Rainbow\Hsl;
use Rainbow\Unit\Percent;

final class Luminance
{
    private $value;

    public function __construct(Hsl $color)
    {
        $this->value = $color->getSaturation()->getValue() ? 100 : 0;
    }

    public function value()
    {
        return new Percent($this->value);
    }
}
