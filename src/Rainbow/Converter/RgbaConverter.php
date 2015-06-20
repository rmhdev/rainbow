<?php

namespace Rainbow\Converter;

use Rainbow\Rgb;
use Rainbow\Rgba;

final class RgbaConverter
{
    /**
     * @var Rgba
     */
    private $color;

    public function __construct(Rgba $color)
    {
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function toRgb()
    {
        return new Rgb(
            $this->getColor()->getRed(),
            $this->getColor()->getGreen(),
            $this->getColor()->getBlue()
        );
    }

    public function toHsl()
    {
        $converter = new RgbConverter($this->toRgb());

        return $converter->toHsl();
    }
}
