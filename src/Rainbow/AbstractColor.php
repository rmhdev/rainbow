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
                $this->localHueValue(),
                $this->localSaturationValue($saturation),
                $this->localLightnessValue()
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
     * @return number
     */
    private function localHueValue()
    {
        return $this->getLocalHsl()->getHue()->getValue();
    }

    /**
     * @param int $percentage
     * @return number
     */
    private function localSaturationValue($percentage = 0)
    {
        $value = $this->getLocalHsl()->getSaturation()->getValue();

        return $this->formatPercentage($value, $percentage);
    }

    private function formatPercentage($value = 0, $percentage = 0)
    {
        if (!$percentage) {
            return $value;
        }
        if ($percentage < 0) {
            return max($value + $percentage, 0);
        }

        return min($value + $percentage, 100);
    }

    /**
     * @param int $percentage
     * @return number
     */
    private function localLightnessValue($percentage = 0)
    {
        $value = $this->getLocalHsl()->getLightness()->getValue();

        return $this->formatPercentage($value, $percentage);
    }

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
                $this->localHueValue(),
                $this->localSaturationValue(-$saturation),
                $this->localLightnessValue()
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
                $this->localHueValue(),
                $this->localSaturationValue(),
                $this->localLightnessValue($lightness)
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function darken($lightness)
    {
        return $this->toCurrent(
            new Hsl(
                $this->localHueValue(),
                $this->localSaturationValue(),
                $this->localLightnessValue(-$lightness)
            )
        );
    }
}
