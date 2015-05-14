<?php

namespace Rainbow\Calculation;

use Rainbow\Calculation\Blending\ColorBurn;
use Rainbow\Calculation\Blending\ColorDodge;
use Rainbow\Calculation\Blending\Difference;
use Rainbow\Calculation\Blending\HardLight;
use Rainbow\Calculation\Blending\Multiply;
use Rainbow\Calculation\Blending\Overlay;
use Rainbow\Calculation\Blending\Screen;
use Rainbow\Calculation\Blending\SoftLight;
use Rainbow\Rgb;

/**
 * Class Blender
 * @package Rainbow\Calculation
 */
final class Blender
{

    /**
     * @var Rgb
     */
    private $color;

    /**
     * @param Rgb $color
     */
    function __construct(Rgb $color)
    {
        $this->color = $color;
    }

    /**
     * @return Rgb
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @see Rainbow\Calculation\Blending\Multiply::result()
     * @param Rgb $color
     * @return Rgb
     */
    public function multiply(Rgb $color)
    {
        $blending = new Multiply($this->getColor(), $color);

        return $blending->result();
    }

    /**
     * @see Rainbow\Calculation\Blending\Screen::result()
     * @param Rgb $color
     * @return Rgb
     */
    public function screen(Rgb $color)
    {
        $blending = new Screen($this->getColor(), $color);

        return $blending->result();
    }

    /**
     * @see Rainbow\Calculation\Blending\Overlay::result()
     * @param Rgb $color
     * @return Rgb
     */
    public function overlay(Rgb $color)
    {
        $blending = new Overlay($this->getColor(), $color);

        return $blending->result();
    }

    /**
     * @see Rainbow\Calculation\Blending\HardLight::result()
     * @param Rgb $color
     * @return Rgb
     */
    public function hardLight(Rgb $color)
    {
        $blending = new HardLight($this->getColor(), $color);

        return $blending->result();
    }

    /**
     * @see Rainbow\Calculation\Blending\SoftLight::result()
     * @param Rgb $color
     * @return Rgb
     */
    public function softLight(Rgb $color)
    {
        $blending = new SoftLight($this->getColor(), $color);

        return $blending->result();
    }

    /**
     * @see Rainbow\Calculation\Blending\Difference::result()
     * @param Rgb $color
     * @return Rgb
     */
    public function difference(Rgb $color)
    {
        $blending = new Difference($this->getColor(), $color);

        return $blending->result();
    }

    /**
     * @see Rainbow\Calculation\Blending\Exclusion::result()
     * @param Rgb $color
     * @return Rgb
     */
    public function exclusion(Rgb $color)
    {
        $blending = new Difference($this->getColor(), $color);

        return $blending->result();
    }

    /**
     * @see Rainbow\Calculation\Blending\ColorDodge::result()
     * @param Rgb $color
     * @return Rgb
     */
    public function colorDodge(Rgb $color)
    {
        $blending = new ColorDodge($this->getColor(), $color);

        return $blending->result();
    }

    /**
     * @see Rainbow\Calculation\Blending\ColorBurn::result()
     * @param Rgb $color
     * @return Rgb
     */
    public function colorBurn(Rgb $color)
    {
        $blending = new ColorBurn($this->getColor(), $color);

        return $blending->result();
    }
}
