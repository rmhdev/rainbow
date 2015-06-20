<?php

namespace Rainbow;

use Rainbow\Unit\Alpha;
use Rainbow\Unit\RgbComponent;

final class Rgba
{
    /**
     * @var Rgb
     */
    private $rgb;

    private $alpha;

    /**
     * @param int|string|RgbComponent $red
     * @param int|string|RgbComponent $green
     * @param int|string|RgbComponent $blue
     * @param int|string|Alpha $alpha
     */
    public function __construct($red = 0, $green = 0, $blue = 0, $alpha = 1)
    {
        $this->rgb = new Rgb($red, $green, $blue);
        $this->alpha = ($alpha instanceof Alpha) ? $alpha : new Alpha($alpha);
    }

    public function getName()
    {
        return "rgba";
    }

    public function getRed()
    {
        return $this->rgb->getRed();
    }

    public function getGreen()
    {
        return $this->rgb->getGreen();
    }

    public function getBlue()
    {
        return $this->rgb->getBlue();
    }

    public function getAlpha()
    {
        return $this->alpha;
    }
}
