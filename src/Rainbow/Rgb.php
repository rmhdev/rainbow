<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow;

use Rainbow\Translator\RgbToHslTranslator;
use Rainbow\Unit\Alpha;
use Rainbow\Unit\Component;

class Rgb implements ColorInterface
{
    private $red;
    private $green;
    private $blue;

    public function __construct($red = 0, $green = 0, $blue = 0)
    {
        $this->red = new Component($red);
        $this->green = new Component($green);
        $this->blue = new Component($blue);
    }

    /**
     * @return Component
     */
    public function getRed()
    {
        return $this->red;
    }

    /**
     * @return Component
     */
    public function getGreen()
    {
        return $this->green;
    }

    /**
     * @return Component
     */
    public function getBlue()
    {
        return $this->blue;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return sprintf("rgb(%s,%s,%s)",
            $this->getRed(),
            $this->getGreen(),
            $this->getBlue()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getAlpha()
    {
        return new Alpha(1);
    }

    public function toRgb()
    {
        return new self(
            $this->getRed()->getValue(),
            $this->getGreen()->getValue(),
            $this->getBlue()->getValue()
        );
    }

    public function toHsl()
    {
        $translator = new RgbToHslTranslator($this);

        return $translator->translate();
    }

    public function getHue()
    {
        return $this->toHsl()->getHue();
    }

    public function getSaturation()
    {
        return $this->toHsl()->getSaturation();
    }

    public function getLightness()
    {
        return $this->toHsl()->getLightness();
    }

    /**
     * {@inheritDoc}
     * @return Rgb
     */
    public function saturate($saturation)
    {
        return $this->toHsl()->saturate($saturation)->toRgb();
    }

    /**
     * {@inheritDoc}
     * @return Rgb
     */
    public function desaturate($saturation)
    {
        return $this->toHsl()->desaturate($saturation)->toRgb();
    }
}
