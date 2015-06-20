<?php

namespace Rainbow\Converter;

use Rainbow\Rgba;

final class RgbaConverter
{
    private $color;

    public function __construct(Rgba $color)
    {
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->color;
    }
}
