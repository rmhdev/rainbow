<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow;

use Rainbow\Component\Alpha;
use Rainbow\Component\Rgb as RgbComponent;

/**
 * Class Rgb
 * @package Rainbow
 * @method Rgb copy()
 * @method Rgb saturate($percentage)
 * @method Rgb desaturate($percentage)
 * @method Rgb lighten($percentage)
 * @method Rgb darken($percentage)
 * @method Rgb spin($angle)
 * @method Rgb greyscale()
 */
class Rgb extends AbstractColor implements ColorInterface, RgbInterface
{
    /**
     * @var RgbComponent
     */
    private $red;

    /**
     * @var RgbComponent
     */
    private $green;

    /**
     * @var RgbComponent
     */
    private $blue;

    /**
     * @param int|string|RgbComponent $red
     * @param int|string|RgbComponent $green
     * @param int|string|RgbComponent $blue
     */
    public function __construct($red = 0, $green = 0, $blue = 0)
    {
        $this->red = ($red instanceof RgbComponent) ? $red : new RgbComponent($red);
        $this->green = ($green instanceof RgbComponent) ? $green : new RgbComponent($green);
        $this->blue = ($blue instanceof RgbComponent) ? $blue : new RgbComponent($blue);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return "rgb";
    }

    /**
     * {@inheritDoc}
     */
    public function getRed()
    {
        return $this->red;
    }

    /**
     * {@inheritDoc}
     */
    public function getGreen()
    {
        return $this->green;
    }

    /**
     * {@inheritDoc}
     */
    public function getBlue()
    {
        return $this->blue;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return sprintf(
            "rgb(%s,%s,%s)",
            $this->getRed(),
            $this->getGreen(),
            $this->getBlue()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getAlpha()
    {
        return new Alpha(1);
    }
}
