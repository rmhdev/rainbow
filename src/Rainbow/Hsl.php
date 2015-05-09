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

/**
 * Class Hsl
 * @package Rainbow
 * @method Hsl saturate($percentage)
 * @method Hsl desaturate($percentage)
 * @method Hsl lighten($percentage)
 * @method Hsl darken($percentage)
 * @method Hsl spin($angle)
 * @method Hsl greyscale()
 */
final class Hsl extends AbstractColor implements ColorInterface
{
    private $hue;
    private $saturation;
    private $lightness;

    /**
     * @param int|number|string $hue  An angle
     * @param int|number|string $saturation  A percentage
     * @param int|number|string $lightness  A percentage
     */
    public function __construct($hue = 0, $saturation = 0, $lightness = 0)
    {
        $this->hue = new Angle($hue);
        $this->saturation = new Percent($saturation);
        $this->lightness = new Percent($lightness);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return "hsl";
    }

    public function getHue()
    {
        return $this->hue;
    }

    public function getSaturation()
    {
        return $this->saturation;
    }

    public function getLightness()
    {
        return $this->lightness;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return sprintf("hsl(%s,%s,%s)",
            $this->getHue(),
            $this->getSaturation(),
            $this->getLightness()
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
     * @return Hsl
     */
    protected function toCurrent(Hsl $color)
    {
        return $color->copy();
    }
}
