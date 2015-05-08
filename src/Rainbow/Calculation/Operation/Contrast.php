<?php

namespace Rainbow\Calculation\Operation;

use Rainbow\Calculation\CalculationInterface;
use Rainbow\Rgb;
use Rainbow\ColorInterface;

final class Contrast implements CalculationInterface
{
    private $contrast;

    public function __construct(Rgb $color, Rgb $dark, Rgb $light)
    {
        $this->contrast = $this->calculateContrast($color, $dark, $light);
    }

    private function calculateContrast(Rgb $color, Rgb $dark, Rgb $light)
    {
        $colorLuma = $color->luma()->getValue();
        $darkLuma = $dark->luma()->getValue();
        $lightLuma = $light->luma()->getValue();
        if (abs($colorLuma - $lightLuma) > abs($colorLuma - $darkLuma)) {

            return $light;
        }

        return $dark;
    }

    /**
     * @return ColorInterface
     */
    public function result()
    {
        return $this->contrast->copy();
    }

}
