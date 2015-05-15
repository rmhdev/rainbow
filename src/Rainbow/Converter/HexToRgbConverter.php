<?php

namespace Rainbow\Converter;

use Rainbow\Rgb;

final class HexToRgbConverter implements ConverterInterface
{
    /**
     * {@inheritDoc}
     */
    public function convert()
    {
        return new Rgb(0, 0, 0);
    }

}
