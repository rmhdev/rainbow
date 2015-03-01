<?php

namespace Rainbow;

abstract class AbstractColor implements ColorInterface
{
    /**
     * @var Hsl
     */
    private $localHsl;

    /**
     * {@inheritDoc}
     */
    public function saturate($saturation)
    {
        return $this->toCurrent(
            new Hsl(
                $this->getLocalHsl()->getHue()->getValue(),
                min($this->getLocalHsl()->getSaturation()->getValue() + $saturation, 100),
                $this->getLocalHsl()->getLightness()->getValue()
            )
        );
    }

    /**
     * Translates back to the current color space
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
            $this->localHsl = $this->toHsl();
        }

        return $this->localHsl;
    }

    /**
     * {@inheritDoc}
     */
    public function desaturate($saturation)
    {
        return $this->toCurrent(
            new Hsl(
                $this->getLocalHsl()->getHue()->getValue(),
                max($this->getLocalHsl()->getSaturation()->getValue() - $saturation, 0),
                $this->getLocalHsl()->getLightness()->getValue()
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function lighten($lightness)
    {
        return $this->toCurrent(
            new Hsl(
                $this->getLocalHsl()->getHue()->getValue(),
                $this->getLocalHsl()->getSaturation()->getValue(),
                min($this->getLocalHsl()->getLightness()->getValue() + $lightness, 100)
            )
        );
    }
}
