<?php

namespace Rainbow\Translator;

use Rainbow\ColorInterface;
use Rainbow\Converter\ConverterFactory;

final class Translator
{
    private $color;

    public function __construct(ColorInterface $color)
    {
        $this->color = $color;
    }

    public function toRgb()
    {
        return ConverterFactory::create($this->getColor(), "rgb")->convert();
    }

    private function getColor()
    {
        return $this->color;
    }

    public function toHsl()
    {
        return ConverterFactory::create($this->getColor(), "hsl")->convert();
    }
}
