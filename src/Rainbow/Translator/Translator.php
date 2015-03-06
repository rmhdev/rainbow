<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Translator;

use Rainbow\ColorInterface;
use Rainbow\Converter\ConverterFactory;
use Rainbow\Rgb;
use Rainbow\Hsl;

final class Translator
{
    private $color;

    /**
     * @param ColorInterface $color  A color to translate
     */
    public function __construct(ColorInterface $color)
    {
        $this->color = $color;
    }

    /**
     * @return Rgb
     */
    public function toRgb()
    {
        return ConverterFactory::create($this->getColor(), "rgb")->convert();
    }

    private function getColor()
    {
        return $this->color;
    }

    /**
     * @return Hsl
     */
    public function toHsl()
    {
        return ConverterFactory::create($this->getColor(), "hsl")->convert();
    }
}
