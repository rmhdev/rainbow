<?php

namespace Rainbow;

use Rainbow\Unit\Alpha;

interface ColorInterface
{
    /**
     * String representation of the color
     * @return string
     */
    public function __toString();

    /**
     * Extract the alpha channel
     * @return Alpha
     */
    public function getAlpha();

    /**
     * Increase the saturation of a color in the HSL color space
     * @param int|string $saturation  A percentage
     * @return ColorInterface
     */
    public function saturate($saturation);

}
