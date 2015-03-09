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

    public function luminance()
    {
        return new Percent(($this->getRed()->getValue() > 0) ? 100 : 0);
    }
}
