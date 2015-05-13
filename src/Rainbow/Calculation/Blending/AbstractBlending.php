<?php

namespace Rainbow\Calculation\Blending;

use Rainbow\Rgb;
use Rainbow\Unit\RgbComponent;

abstract class AbstractBlending
{
    /**
     * @var Rgb
     */
    private $result;

    /**
     * @param Rgb $color1
     * @param Rgb $color2
     */
    public function __construct(Rgb $color1, Rgb $color2)
    {
        $red = $this->calculateComponentValue($color1->getRed(), $color2->getRed());
        $green = $this->calculateComponentValue($color1->getGreen(), $color2->getGreen());
        $blue = $this->calculateComponentValue($color1->getBlue(), $color2->getBlue());

        $this->result = new Rgb($red, $green, $blue);
    }

    /**
     * @param RgbComponent $component1
     * @param RgbComponent $component2
     * @return int
     */
    abstract protected function calculateComponentValue(RgbComponent $component1, RgbComponent $component2);

    /**
     * @param RgbComponent $component1
     * @param RgbComponent $component2
     * @return float
     */
    protected function multiply(RgbComponent $component1, RgbComponent $component2)
    {
        return $component1->getValue() * $component2->getValue() / RgbComponent::MAX_VALUE;
    }

    /**
     * @return Rgb
     */
    public function result()
    {
        return $this->result->copy();
    }
}
