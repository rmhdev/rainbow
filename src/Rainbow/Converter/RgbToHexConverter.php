<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Converter;

use Rainbow\ColorInterface;
use Rainbow\Hex;
use Rainbow\Rgb;
use Rainbow\Unit\HexComponent;

final class RgbToHexConverter implements ConverterInterface
{
    /**
     * @var Rgb
     */
    private $color;

    /**
     * @var string
     */
    private $hexValue;

    /**
     * @param Rgb $color
     */
    function __construct(Rgb $color)
    {
        $this->color = $color;
        $this->hexValue = null;
    }

    /**
     * Returns the converted color
     * @return ColorInterface
     */
    public function convert()
    {
        if (!$this->isConverted()) {
            $this->updateHexValue();
        }

        return new Hex($this->hexValue);
    }

    private function isConverted()
    {
        return !is_null($this->hexValue);
    }

    private function updateHexValue()
    {
        $redHEx     = new HexComponent(dechex((string)$this->color->getRed()));
        $greenHEx   = new HexComponent(dechex((string)$this->color->getGreen()));
        $blueHEx    = new HexComponent(dechex((string)$this->color->getBlue()));

        $this->hexValue = sprintf(
            "#%s%s%s",
            $redHEx->getValue(),
            $greenHEx->getValue(),
            $blueHEx->getValue()
        );
    }
}
