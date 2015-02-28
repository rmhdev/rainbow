<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow;

use Rainbow\Unit\Alpha;
use Rainbow\Unit\Angle;
use Rainbow\Unit\Component;
use Rainbow\Unit\Percent;

final class Hsl implements ColorInterface
{
    private $hue;
    private $saturation;
    private $lightness;

    public function __construct($hue = 0, $saturation = 0, $lightness = 0)
    {
        $this->hue = new Angle($hue);
        $this->saturation = new Percent($saturation);
        $this->lightness = new Percent($lightness);
    }

    public function getHue()
    {
        return $this->hue;
    }

    public function getSaturation()
    {
        return $this->saturation;
    }

    public function getLightness()
    {
        return $this->lightness;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return sprintf("hsl(%s,%s,%s)",
            $this->getHue(),
            $this->getSaturation(),
            $this->getLightness()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getAlpha()
    {
        return new Alpha(1);
    }

    public function toHsl()
    {
        return new self(
            $this->getHue()->getValue(),
            $this->getSaturation()->getValue(),
            $this->getLightness()->getValue()
        );
    }

    public function toRgb()
    {
        list($red, $green, $blue) = $this->calculateRgbValues();

        return new Rgb($red, $green, $blue);
    }

    /**
     * @url http://www.w3.org/TR/css3-color/#hsl-color
     */
    private function calculateRgbValues()
    {
        $hue = $this->getHue()->getValue() / 360;
        $saturation = $this->getSaturation()->getValue() / 100;
        $lightness = $this->getLightness()->getValue() / 100;

        $m2 = (0.5 >= $lightness) ?
            $lightness * ($saturation + 1) :
            $lightness + $saturation - ($lightness * $saturation);
        $m1 = $lightness * 2 - $m2;

        $red = $this->hueToRgb($m1, $m2, $hue + 1/3);
        $green = $this->hueToRgb($m1, $m2, $hue);
        $blue = $this->hueToRgb($m1, $m2, $hue - 1/3);

        return array(
            $red * Component::MAX_INT,
            $green * Component::MAX_INT,
            $blue * Component::MAX_INT
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

    public function getRed()
    {
        return $this->toRgb()->getRed();
    }

    public function getGreen()
    {
        return $this->toRgb()->getGreen();
    }

    public function getBlue()
    {
        return $this->toRgb()->getBlue();
    }

    /**
     * {@inheritDoc}
     * @return Hsl
     */
    public function saturate($saturation)
    {
        return new self(
            $this->getHue()->getValue(),
            min($this->getSaturation()->getValue() + $saturation, 100),
            $this->getLightness()->getValue()
        );
    }
}
