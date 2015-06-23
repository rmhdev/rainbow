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
 * @method Hsl copy()
 * @method Hsl saturate($percentage)
 * @method Hsl desaturate($percentage)
 * @method Hsl lighten($percentage)
 * @method Hsl darken($percentage)
 * @method Hsl spin($angle)
 * @method Hsl greyscale()
 */
final class Hsl extends AbstractColor implements ColorInterface, HslInterface
{
    /**
     * @var Angle
     */
    private $hue;

    /**
     * @var Percent
     */
    private $saturation;

    /**
     * @var Percent
     */
    private $lightness;

    /**
     * @param int|string|Angle $hue  An angle
     * @param int|string|Percent $saturation  A percentage
     * @param int|string|Percent $lightness  A percentage
     */
    public function __construct($hue = 0, $saturation = 0, $lightness = 0)
    {
        $this->hue = ($hue instanceof Angle) ? $hue : new Angle($hue);
        $this->saturation = ($saturation instanceof Percent) ? $saturation : new Percent($saturation);
        $this->lightness = ($lightness instanceof Percent) ? $lightness : new Percent($lightness);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return "hsl";
    }

    /**
     * {@inheritDoc}
     */
    public function getHue()
    {
        return $this->hue;
    }

    /**
     * {@inheritDoc}
     */
    public function getSaturation()
    {
        return $this->saturation;
    }

    /**
     * {@inheritDoc}
     */
    public function getLightness()
    {
        return $this->lightness;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return sprintf(
            "hsl(%s,%s,%s)",
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
}
