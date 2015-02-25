<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow;

use Rainbow\Unit\Angle;
use Rainbow\Unit\Percent;

final class Hsl
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
}
