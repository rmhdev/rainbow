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
use Rainbow\Unit\Percent;

/**
 * Class Rgb
 * @package Rainbow
 * @method Rgb saturate($percentage)
 * @method Rgb desaturate($percentage)
 * @method Rgb lighten($percentage)
 * @method Rgb darken($percentage)
 */
class Rgb extends AbstractColor implements ColorInterface
{
    private $red;
    private $green;
    private $blue;

    /**
     * @param int|number $red
     * @param int|number $green
     * @param int|number $blue
     */
    public function __construct($red = 0, $green = 0, $blue = 0)
    {
        $this->red = new Component($red);
        $this->green = new Component($green);
        $this->blue = new Component($blue);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return "rgb";
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

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return sprintf("rgb(%s,%s,%s)",
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

    /**
     * {@inheritDoc}
     * @return Rgb
     */
    protected function toCurrent(Hsl $color)
    {
        return $color->getTranslator()->toRgb();
    }

    /**
     * @return Percent
     * @url http://www.w3.org/TR/2008/REC-WCAG20-20081211/#relativeluminancedef
     */
    public function luminance()
    {
        $red = $this->getRed()->getValue() / Component::MAX_VALUE;
        $green = $this->getGreen()->getValue() / Component::MAX_VALUE;
        $blue = $this->getBlue()->getValue() / Component::MAX_VALUE;

        $red    = ($red <= 0.03928)     ? $red / 12.92 : (($red + 0.055) / 1.055) ** 2.4;
        $green  = ($green <= 0.03928)   ? $green / 12.92 : (($green + 0.055) / 1.055) ** 2.4;
        $blue   = ($blue <= 0.03928)    ? $blue / 12.92 : (($blue + 0.055) / 1.055) ** 2.4;

        $value = 0.2126 * $red + 0.7152 * $green + 0.0722 * $blue;

        return new Percent($value * 100);
    }
}
