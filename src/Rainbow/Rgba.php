<?php

namespace Rainbow;

use Rainbow\Unit\Alpha;

final class Rgba
{
    /**
     * @var Rgb
     */
    private $rgb;

    private $alpha;

    public function __construct($red = 0, $green = 0, $blue = 0, $alpha = 1)
    {
        $this->rgb = new Rgb($red, $green, $blue);
        $this->alpha = new Alpha($alpha);
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
