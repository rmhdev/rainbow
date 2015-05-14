<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow;

use Rainbow\Calculation\Channel\Luma;
use Rainbow\Calculation\Channel\Luminance;
use Rainbow\Calculation\Operation\Contrast;
use Rainbow\Calculation\Operation\Lightness;
use Rainbow\Calculation\Operation\Saturation;
use Rainbow\Calculation\Operation\Spin;
use Rainbow\Calculation\Blender;
use Rainbow\Translator\Translator;

abstract class AbstractColor implements ColorInterface
{
    /**
     * @var Hsl
     */
    private $localHsl;

    /**
     * @var Blender
     */
    private $blender;

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
     * Converts back to the current color space
     * @param ColorInterface $color
     * @return ColorInterface
     */
    private function toCurrent(ColorInterface $color)
    {
        if ($this->getName() === $color->getName()) {
            return $color->copy();
        }

        return $color->translate()->to($this->getName());
    }

    /**
     * {@inheritDoc}
     */
    public function desaturate($percentage)
    {
        return $this->updateSaturation(-$percentage);
    }

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
        return $this->toCurrent(
            $this->getBlender()->multiply($color->translate()->toRgb())
        );
    }

    /**
     * @return Blender
     */
    protected function getBlender()
    {
        if (!$this->blender) {
            $this->blender = new Blender($this->translate()->toRgb());
        }

        return $this->blender;
    }

    /**
     * {@inheritDoc}
     */
    public function screen(ColorInterface $color)
    {
        return $this->toCurrent(
            $this->getBlender()->screen($color->translate()->toRgb())
        );
    }

    /**
     * {@inheritDoc}
     */
    public function overlay(ColorInterface $color)
    {
        return $this->toCurrent(
            $this->getBlender()->overlay($color->translate()->toRgb())
        );
    }

    /**
     * {@inheritDoc}
     */
    public function hardLight(ColorInterface $color)
    {
        return $this->toCurrent(
            $this->getBlender()->hardLight($color->translate()->toRgb())
        );
    }

    /**
     * {@inheritDoc}
     */
    public function softLight(ColorInterface $color)
    {
        return $this->toCurrent(
            $this->getBlender()->softLight($color->translate()->toRgb())
        );
    }

    /**
     * {@inheritDoc}
     */
    public function difference(ColorInterface $color)
    {
        return $this->toCurrent(
            $this->getBlender()->difference($color->translate()->toRgb())
        );
    }

    /**
     * {@inheritDoc}
     */
    public function exclusion(ColorInterface $color)
    {
        return $this->toCurrent(
            $this->getBlender()->exclusion($color->translate()->toRgb())
        );
    }
}
