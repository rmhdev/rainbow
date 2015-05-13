<?php

namespace Rainbow\Calculation\Blending\Unit;

use Rainbow\Unit\RgbComponent;

final class UnitMultiply
{
    private $value;

    public function __construct(RgbComponent $component1, RgbComponent $component2)
    {
        $this->value = $component1->getValue() * $component2->getValue() / RgbComponent::MAX_VALUE;
    }

    public function result()
    {
        return new RgbComponent($this->value);
    }
}
