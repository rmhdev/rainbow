<?php

namespace Rainbow\Converter;

use Rainbow\ColorInterface;
use Rainbow\Hex;

final class RgbToHexConverter implements ConverterInterface
{
    /**
     * Returns the converted color
     * @return ColorInterface
     */
    public function convert()
    {
        return new Hex("#000000");
    }
}
