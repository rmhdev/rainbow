<?php

namespace Rainbow\Tests;

use Rainbow\Hsl;
use Rainbow\Rgb;

abstract class AbstractColorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param array $values
     * @return Rgb
     */
    public function createRgb($values)
    {
        return new Rgb(
            $values["red"],
            $values["green"],
            $values["blue"]
        );
    }

    /**
     * @param array $values
     * @return Hsl
     */
    public function createHsl($values)
    {
        return new Hsl(
            $values["hue"],
            $values["saturation"],
            $values["lightness"]
        );
    }
}
