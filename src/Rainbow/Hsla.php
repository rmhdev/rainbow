<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow;

final class Hsla
{
    private $hsl;

    public function __construct()
    {
        $this->hsl = new Hsl();
    }

    public function getName()
    {
        return "hsla";
    }

    public function getHue()
    {
        return $this->hsl->getHue();
    }

    public function getSaturation()
    {
        return $this->hsl->getSaturation();
    }

    public function getLightness()
    {
        return $this->hsl->getLightness();
    }
}
