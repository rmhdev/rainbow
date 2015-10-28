<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Calculation;

use Rainbow\Calculation\Blending\ColorBurn;
use Rainbow\Calculation\Blending\ColorDodge;
use Rainbow\Calculation\Blending\Difference;
use Rainbow\Calculation\Blending\Exclusion;
use Rainbow\Calculation\Blending\HardLight;
use Rainbow\Calculation\Blending\Multiply;
use Rainbow\Calculation\Blending\Overlay;
use Rainbow\Calculation\Blending\Screen;
use Rainbow\Calculation\Blending\SoftLight;
use Rainbow\Rgba;

/**
 * Class Blender
 * @package Rainbow\Calculation
 */
final class Blender
{

    /**
     * @var Rgba
     */
    private $color;

    /**
     * @param Rgba $color
     */
    public function __construct(Rgba $color)
    {
        $this->color = $color;
    }

    /**
     * @return Rgba
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @see Rainbow\Calculation\Blending\Multiply::result()
     * @param Rgba $color
     * @return Rgba
     */
    public function multiply(Rgba $color)
    {
        $blending = new Multiply($this->getColor(), $color);

        return $blending->result();
    }

    /**
     * @see Rainbow\Calculation\Blending\Screen::result()
     * @param Rgba $color
     * @return Rgba
     */
    public function screen(Rgba $color)
    {
        $blending = new Screen($this->getColor(), $color);

        return $blending->result();
    }

    /**
     * @see Rainbow\Calculation\Blending\Overlay::result()
     * @param Rgba $color
     * @return Rgba
     */
    public function overlay(Rgba $color)
    {
        $blending = new Overlay($this->getColor(), $color);

        return $blending->result();
    }

    /**
     * @see Rainbow\Calculation\Blending\HardLight::result()
     * @param Rgba $color
     * @return Rgba
     */
    public function hardLight(Rgba $color)
    {
        $blending = new HardLight($this->getColor(), $color);

        return $blending->result();
    }

    /**
     * @see Rainbow\Calculation\Blending\SoftLight::result()
     * @param Rgba $color
     * @return Rgba
     */
    public function softLight(Rgba $color)
    {
        $blending = new SoftLight($this->getColor(), $color);

        return $blending->result();
    }

    /**
     * @see Rainbow\Calculation\Blending\Difference::result()
     * @param Rgba $color
     * @return Rgba
     */
    public function difference(Rgba $color)
    {
        $blending = new Difference($this->getColor(), $color);

        return $blending->result();
    }

    /**
     * @see Rainbow\Calculation\Blending\Exclusion::result()
     * @param Rgba $color
     * @return Rgba
     */
    public function exclusion(Rgba $color)
    {
        $blending = new Exclusion($this->getColor(), $color);

        return $blending->result();
    }

    /**
     * @see Rainbow\Calculation\Blending\ColorDodge::result()
     * @param Rgba $color
     * @return Rgba
     */
    public function colorDodge(Rgba $color)
    {
        $blending = new ColorDodge($this->getColor(), $color);

        return $blending->result();
    }

    /**
     * @see Rainbow\Calculation\Blending\ColorBurn::result()
     * @param Rgba $color
     * @return Rgba
     */
    public function colorBurn(Rgba $color)
    {
        $blending = new ColorBurn($this->getColor(), $color);

        return $blending->result();
    }
}
