<?php

namespace Rainbow;

use Rainbow\Component\Angle;
use Rainbow\Component\Percent;

interface HslInterface
{
    /**
     * @return Angle
     */
    public function getHue();

    /**
     * @return Percent
     */
    public function getSaturation();

    /**
     * @return Percent
     */
    public function getLightness();
}
