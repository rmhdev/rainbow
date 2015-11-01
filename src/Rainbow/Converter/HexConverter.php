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
use Rainbow\Component\Hex as HexComponent;

final class HexConverter implements ConverterInterface
{
    /**
     * @var Hex
     */
    private $color;

    /**
     * @param Hex $color
     */
    public function __construct(Hex $color)
    {
        $this->color = $color;
    }

    /**
     * {@inheritDoc}
     * @return Hex
     */
    public function getColor()
    {
        return clone $this->color;
    }

    /**
     * {@inheritDoc}
     */
    public function toRgb()
    {
        return new Rgb(
            hexdec($this->color->getRed()->getValue()),
            hexdec($this->color->getGreen()->getValue()),
            hexdec($this->color->getBlue()->getValue())
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toHsl()
    {
        $converter = new RgbConverter($this->toRgb());

        return $converter->toHsl();
    }

    /**
     * {@inheritDoc}
     * @return HexConverter
     */
    public static function create(ColorInterface $color)
    {
        if ($color instanceof Hex) {
            return new self($color);
        }
        if (!$color instanceof Rgb) {
            $converter = RgbConverter::create($color);
            $color = $converter->toRgb();
        }

        return self::createFromRgb($color);
    }

    private static function createFromRgb(Rgb $color)
    {
        $redHEx     = new HexComponent(dechex((string)$color->getRed()));
        $greenHEx   = new HexComponent(dechex((string)$color->getGreen()));
        $blueHEx    = new HexComponent(dechex((string)$color->getBlue()));

        $hexValue = sprintf(
            "#%s%s%s",
            $redHEx->getValue(),
            $greenHEx->getValue(),
            $blueHEx->getValue()
        );

        return new self(new Hex($hexValue));
    }
}
