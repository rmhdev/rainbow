<?php

namespace Rainbow;

use Rainbow\Unit\Alpha;

final class Rgba
{
    /**
     * @var Rgb
     */
    private $rgb;

    public function __construct()
    {
        $this->rgb = new Rgb();
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
        return new Alpha(1);
    }
}
