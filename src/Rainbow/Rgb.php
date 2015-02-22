<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow;

use Rainbow\Unit\Dimension;

class Rgb
{
    private $red;
    private $green;
    private $blue;

    public function __construct($red = 0, $green = 0, $blue = 0)
    {
        $this->setRed($red);
        $this->setGreen($green);
        $this->setBlue($blue);
    }

    private function setRed($value)
    {
        $this->red = new Dimension($value);
    }

    private function setGreen($value)
    {
        return $this->green = new Dimension($value);
    }

    private function setBlue($value)
    {
        return $this->blue = new Dimension($value);
    }

    /**
     * @return Dimension
     */
    public function getRed()
    {
        return $this->red;
    }

    /**
     * @return Dimension
     */
    public function getGreen()
    {
        return $this->green;
    }

    /**
     * @return Dimension
     */
    public function getBlue()
    {
        return $this->blue;
    }
}
