<?php

namespace Rainbow;

use Rainbow\Unit\Angle;
use Rainbow\Unit\Percent;

interface HslaInterface
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
