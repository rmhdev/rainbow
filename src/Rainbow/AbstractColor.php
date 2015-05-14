<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow;

use Rainbow\Calculation\Blending\HardLight;
use Rainbow\Calculation\Blending\Multiply;
use Rainbow\Calculation\Blending\Overlay;
use Rainbow\Calculation\Blending\Screen;
use Rainbow\Calculation\Channel\Luma;
use Rainbow\Calculation\Channel\Luminance;
use Rainbow\Calculation\Operation\Contrast;
use Rainbow\Calculation\Operation\Lightness;
use Rainbow\Calculation\Operation\Saturation;
use Rainbow\Calculation\Operation\Spin;
use Rainbow\Translator\Translator;

abstract class AbstractColor implements ColorInterface
{
    /**
     * @var Hsl
     */
    private $localHsl;

    /**
     * {@inheritDoc}
     */
    public function copy()
    {
        return clone $this;
    }

    /**
     * {@inheritDoc}
     */
    public function saturate($percentage)
    {
        return $this->updateSaturation($percentage);
    }

    private function updateSaturation($percentage)
    {
        $saturation = new Saturation($this->getLocalHsl(), $percentage);

        return $this->toCurrent(new Hsl(
            $this->getLocalHsl()->getHue()->getValue(),
            $saturation->result(),
            $this->getLocalHsl()->getLightness()->getValue()
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function desaturate($percentage)
    {
        return $this->updateSaturation(-$percentage);
    }

    /**
     * Converts back to the current color space
     * @param Hsl $color
     * @return ColorInterface
     */
    abstract protected function toCurrent(Hsl $color);

    /**
     * @return Hsl
     */
    private function getLocalHsl()
    {
        if (is_null($this->localHsl)) {
            $this->localHsl = $this->translate()->toHsl();
        }

        return $this->localHsl;
    }

    /**
     * {@inheritDoc}
     */
    public function lighten($percentage)
    {
        return $this->updateLightnessValue($percentage);
    }

    /**
     * @param $percentage
     * @return ColorInterface
     */
    private function updateLightnessValue($percentage)
    {
        $lightness = new Lightness($this->getLocalHsl(), $percentage);

        return $this->toCurrent(new Hsl(
            $this->getLocalHsl()->getHue()->getValue(),
            $this->getLocalHsl()->getSaturation()->getValue(),
            $lightness->result()
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function darken($percentage)
    {
        return $this->updateLightnessValue(-$percentage);
    }

    /**
     * {@inheritDoc}
     */
    public function spin($angle)
    {
        $operation = new Spin($this->getLocalHsl(), $angle);

        return $this->toCurrent(new Hsl(
            $operation->result()->getValue(),
            $this->getLocalHsl()->getSaturation()->getValue(),
            $this->getLocalHsl()->getLightness()->getValue()
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function translate()
    {
        return new Translator($this);
    }

    /**
     * {@inheritDoc}
     */
    public function luma()
    {
        $channel = new Luma($this->translate()->toRgb());

        return $channel->result();
    }

    /**
     * {@inheritDoc}
     */
    public function luminance()
    {
        $channel = new Luminance($this->translate()->toRgb());

        return $channel->result();
    }

    /**
     * {@inheritDoc}
     */
    public function greyscale()
    {
        return $this->toCurrent(new Hsl(
            $this->getLocalHsl()->getHue()->getValue(),
            0,
            $this->getLocalHsl()->getLightness()->getValue()
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function contrast(ColorInterface $dark, ColorInterface $light)
    {
        $operation = new Contrast($this, $dark, $light);

        return $operation->result();
    }

    /**
     * {@inheritDoc}
     */
    public function multiply(ColorInterface $color)
    {
        $operation = new Multiply($this->translate()->toRgb(), $color->translate()->toRgb());

        return $operation->result()->translate()->to($this->getName());
    }

    /**
     * {@inheritDoc}
     */
    public function screen(ColorInterface $color)
    {
        $operation = new Screen($this->translate()->toRgb(), $color->translate()->toRgb());

        return $operation->result()->translate()->to($this->getName());
    }

    /**
     * {@inheritDoc}
     */
    public function overlay(ColorInterface $color)
    {
        $operation = new Overlay($this->translate()->toRgb(), $color->translate()->toRgb());

        return $operation->result()->translate()->to($this->getName());
    }

    public function hardLight(ColorInterface $color)
    {
        $operation = new HardLight($this->translate()->toRgb(), $color->translate()->toRgb());

        return $operation->result()->translate()->to($this->getName());
    }
}
