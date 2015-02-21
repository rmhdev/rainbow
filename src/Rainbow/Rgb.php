<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow;

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
        if ($value < 0) {
            throw new \OutOfBoundsException("Incorrect red value");
        }
        $this->red = $value;
    }

    private function setGreen($value)
    {
        if ($value < 0) {
            throw new \OutOfBoundsException("Incorrect green value");
        }

        return $this->green = $value;
    }

    private function setBlue($value)
    {
        if ($value < 0) {
            throw new \OutOfBoundsException("Incorrect blue value");
        }

        return $this->blue = $value;
    }

    public function getRed()
    {
        return $this->red;
    }

    public function getGreen()
    {
        return $this->green;
    }

    public function getBlue()
    {
        return $this->blue;
    }
}
