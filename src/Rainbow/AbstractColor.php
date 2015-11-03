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
use Rainbow\Compositing\Blender;
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

        return $this->editLocalHsl(null, $saturation->result(), null);
    }

    private function editLocalHsl($hue = null, $saturation = null, $lightness = null)
    {
        return $this->toCurrent(
            new Hsl(
                is_null($hue) ? $this->getLocalHsl()->getHue() : $hue,
                is_null($saturation) ? $this->getLocalHsl()->getSaturation() : $saturation,
                is_null($lightness) ? $this->getLocalHsl()->getLightness() : $lightness
            )
        );
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

        return $this->editLocalHsl(null, null, $lightness->result());
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

        return $this->editLocalHsl($operation->result(), null, null);
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
        return $this->editLocalHsl(null, 0, null);
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
     * @return Blender
     */
    public function getBlender()
    {
        if (!$this->blender) {
            $rgb = $this->translate()->toRgb();
            $this->blender = new Blender(
                new Rgba(
                    $rgb->getRed(),
                    $rgb->getGreen(),
                    $rgb->getBlue(),
                    1
                )
            );
        }

        return $this->blender;
    }
}
