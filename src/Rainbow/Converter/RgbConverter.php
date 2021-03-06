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
use Rainbow\Hsl;
use Rainbow\Rgb;
use Rainbow\Component\Rgb as RgbComponent;

final class RgbConverter implements ConverterInterface
{
    /**
     * @var Rgb
     */
    private $color;

    /**
     * @param Rgb $color
     */
    public function __construct(Rgb $color)
    {
        $this->color = $color;
    }

    /**
     * {@inheritDoc}
     * @return Rgb
     */
    public function getColor()
    {
        return $this->color->copy();
    }

    /**
     * {@inheritDoc}
     */
    public function toRgb()
    {
        return $this->color->copy();
    }

    /**
     * {@inheritDoc}
     */
    public function toHsl()
    {
        list($hue, $saturation, $lightness) = $this->calculateHslValues();

        return new Hsl($hue, $saturation, $lightness);
    }

    /**
     * @url https://hg.python.org/cpython/file/2.7/Lib/colorsys.py
     * @return array
     */
    private function calculateHslValues()
    {
        $red = $this->color->getRed()->getValue() / RgbComponent::MAX_VALUE;
        $green = $this->color->getGreen()->getValue() / RgbComponent::MAX_VALUE;
        $blue = $this->color->getBlue()->getValue() / RgbComponent::MAX_VALUE;

        $max = max($red, $green, $blue);
        $min = min($red, $green, $blue);
        $delta = $max - $min;
        $lightness = ($max + $min) / 2;
        if (0 == $delta) {
            return array(0, 0, $lightness * 100);
        }
        $saturation = (0.5 >= $lightness) ?
            ($delta / ($max + $min)) :
            ($delta / (2.0 - $max - $min));
        switch ($max) {
            case $red:
                $hue = (($green - $blue) / $delta);
                break;
            case $green:
                $hue = (($blue - $red) / $delta) + 2;
                break;
            default:
                $hue = (($red - $green) / $delta) + 4;
        }
        $hue = $hue * (360 / 6);

        return array($hue, $saturation * 100, $lightness * 100);
    }

    /**
     * {@inheritDoc}
     * @return RgbConverter
     */
    public static function create(ColorInterface $color)
    {
        if ($color instanceof Rgb) {
            return new self($color);
        }
        $className = sprintf('Rainbow\Converter\%sConverter', ucfirst($color->getName()));
        if (!class_exists($className)) {
            throw new \UnexpectedValueException("{$className} does not exist");
        }
        /* @var ConverterInterface $converter */
        $converter = new $className($color);

        return new RgbConverter($converter->toRgb());
    }
}
