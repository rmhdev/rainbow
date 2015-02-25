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
use Rainbow\Unit\Component;

class Rgb
{
    private $red;
    private $green;
    private $blue;

    public function __construct($red = 0, $green = 0, $blue = 0)
    {
        $this
            ->setRed($red)
            ->setGreen($green)
            ->setBlue($blue);
    }

    private function setRed($value)
    {
        $this->red = new Component($value);

        return $this;
    }

    private function setGreen($value)
    {
        $this->green = new Component($value);

        return $this;
    }

    private function setBlue($value)
    {
        $this->blue = new Component($value);

        return $this;
    }

    /**
     * @return Component
     */
    public function getRed()
    {
        return $this->red;
    }

    /**
     * @return Component
     */
    public function getGreen()
    {
        return $this->green;
    }

    /**
     * @return Component
     */
    public function getBlue()
    {
        return $this->blue;
    }

    public function __toString()
    {
        return sprintf("rgb(%s,%s,%s)",
            $this->getRed(),
            $this->getGreen(),
            $this->getBlue()
        );
    }

    public function getAlpha()
    {
        return new Alpha(1);
    }
}
