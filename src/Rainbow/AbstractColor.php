<?php

namespace Rainbow;

abstract class AbstractColor implements ColorInterface
{
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

    private function getLocalHsl()
    {
        if (is_null($this->localHsl)) {
            $this->localHsl = $this->toHsl();
        }

        return $this->localHsl;
    }

    /**
     * Translates back to the current color space
     * @param Hsl $color
     * @return ColorInterface
     */
    abstract protected function toCurrent(Hsl $color);
}
