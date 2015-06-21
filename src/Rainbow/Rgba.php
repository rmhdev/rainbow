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
use Rainbow\Unit\RgbComponent;

final class Rgba extends AbstractColor implements ColorInterface, RgbInterface
{
    /**
     * @var Rgb
     */
    private $rgb;

    /**
     * @var Alpha
     */
    private $alpha;

    /**
     * @param int|string|RgbComponent $red
     * @param int|string|RgbComponent $green
     * @param int|string|RgbComponent $blue
     * @param int|string|Alpha $alpha
     */
    public function __construct($red = 0, $green = 0, $blue = 0, $alpha = 1)
    {
        $this->rgb = new Rgb($red, $green, $blue);
        $this->alpha = ($alpha instanceof Alpha) ? $alpha : new Alpha($alpha);
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return sprintf(
            "rgb(%s,%s,%s,%s)",
            $this->getRed(),
            $this->getGreen(),
            $this->getBlue(),
            $this->getAlpha()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return "rgba";
    }

    /**
     * {@inheritDoc}
     */
    public function getRed()
    {
        return $this->rgb->getRed();
    }

    /**
     * {@inheritDoc}
     */
    public function getGreen()
    {
        return $this->rgb->getGreen();
    }

    /**
     * {@inheritDoc}
     */
    public function getBlue()
    {
        return $this->rgb->getBlue();
    }

    /**
     * {@inheritDoc}
     */
    public function getAlpha()
    {
        return $this->alpha;
    }
}
