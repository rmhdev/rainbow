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
use Rainbow\Unit\RgbComponent;

final class HslConverter
{
    /**
     * @var Hsl
     */
    private $color;

    /**
     * @param Hsl $color
     */
    public function __construct(Hsl $color)
    {
        $this->color = $color;
    }

    /**
     * {@inheritDoc}
     * @return Hsl
     */
    public function getColor()
    {
        return $this->color->copy();
    }

    /**
     * {@inheritDoc}
     * @return Rgb
     */
    public function toRgb()
    {
        list($red, $green, $blue) = $this->calculateRgbValues();

        return new Rgb($red, $green, $blue);
    }

    /**
     * {@inheritDoc}
     * @return Hsl
     */
    public function toHsl()
    {
        return $this->color->copy();
    }

    private function calculateRgbValues()
    {
        $hue = $this->color->getHue()->getValue() / 360;
        $saturation = $this->color->getSaturation()->getValue() / 100;
        $lightness = $this->color->getLightness()->getValue() / 100;

        $m2 = (0.5 >= $lightness) ?
            $lightness * ($saturation + 1) :
            $lightness + $saturation - ($lightness * $saturation);
        $m1 = $lightness * 2 - $m2;

        $red = $this->hueToRgb($m1, $m2, $hue + 1/3);
        $green = $this->hueToRgb($m1, $m2, $hue);
        $blue = $this->hueToRgb($m1, $m2, $hue - 1/3);

        return array(
            $red * RgbComponent::MAX_VALUE,
            $green * RgbComponent::MAX_VALUE,
            $blue * RgbComponent::MAX_VALUE
        );
    }

    private function hueToRgb($m1, $m2, $hue)
    {
        if (0 > $hue) {
            $hue += 1;
        } elseif (1 < $hue) {
            $hue -= 1;
        }
        if (1 > ($hue * 6)) {
            return $m1 + ($m2 - $m1) * $hue * 6;
        }
        if (1 > ($hue * 2)) {
            return $m2;
        }
        if (2 > $hue * 3) {
            return $m1 + ($m2 - $m1) * (2/3 - $hue) * 6;
        }

        return $m1;
    }

    /**
     * {@inheritDoc}
     * @return HslConverter
     */
    public static function create(ColorInterface $color)
    {
        if ($color instanceof Hsl) {
            return new self($color);
        }
        $className = sprintf('Rainbow\Converter\%sConverter', ucfirst($color->getName()));
        if (!class_exists($className)) {
            throw new \UnexpectedValueException("{$className} does not exist");
        }
        /* @var ConverterInterface $converter */
        $converter = new $className($color);

        return new self($converter->toHsl());
    }
}
