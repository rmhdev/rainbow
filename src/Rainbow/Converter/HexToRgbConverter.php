<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Converter;

use Rainbow\Hex;
use Rainbow\Rgb;

final class HexToRgbConverter implements ConverterInterface
{
    /**
     * @var Hex
     */
    private $color;

    /**
     * @var int
     */
    private $red;

    /**
     * @var int
     */
    private $green;

    /**
     * @var int
     */
    private $blue;

    /**
     * @param Hex $color
     */
    function __construct(Hex $color)
    {
        $this->color = $color;
    }

    /**
     * {@inheritDoc}
     */
    public function convert()
    {
        if (!$this->isConverted()) {
            $this->updateComponents();
        }

        return new Rgb($this->red, $this->green, $this->blue);
    }

    private function isConverted()
    {
        return !is_null($this->red);
    }

    private function updateComponents()
    {
        $this->red = hexdec($this->color->getRed()->getValue());
        $this->green = hexdec($this->color->getGreen()->getValue());
        $this->blue = hexdec($this->color->getBlue()->getValue());
    }
}
