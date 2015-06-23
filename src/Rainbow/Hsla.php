<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow;

use Rainbow\Unit\Alpha;

use Rainbow\Unit\Angle;
use Rainbow\Unit\Percent;

final class Hsla extends AbstractColor implements ColorInterface, HslaInterface
{
    /**
     * @var Hsl
     */
    private $hsl;

    /**
     * @var Alpha
     */
    private $alpha;

    /**
     * @param int|string|Angle $hue  An angle
     * @param int|string|Percent $saturation  A percentage
     * @param int|string|Percent $lightness  A percentage
     * @param int|string|Alpha $alpha  A opacity value
     */
    public function __construct($hue = 0, $saturation = 0, $lightness = 0, $alpha = 1)
    {
        $this->hsl = new Hsl($hue, $saturation, $lightness);
        $this->alpha = ($alpha instanceof Alpha) ? $alpha : new Alpha($alpha);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return "hsla";
    }

    /**
     * {@inheritDoc}
     */
    public function getHue()
    {
        return $this->hsl->getHue();
    }

    /**
     * {@inheritDoc}
     */
    public function getSaturation()
    {
        return $this->hsl->getSaturation();
    }

    /**
     * {@inheritDoc}
     */
    public function getLightness()
    {
        return $this->hsl->getLightness();
    }

    /**
     * {@inheritDoc}
     */
    public function getAlpha()
    {
        return $this->alpha;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return sprintf(
            "hsla(%s,%s,%s,%s)",
            $this->getHue(),
            $this->getSaturation(),
            $this->getLightness(),
            $this->getAlpha()
        );
    }
}
