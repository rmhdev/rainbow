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
use Rainbow\Component\Hex as HexComponent;

/**
 * Class Hex
 * @package Rainbow
 * @method Hex copy()
 * @method Hex saturate($percentage)
 * @method Hex desaturate($percentage)
 * @method Hex lighten($percentage)
 * @method Hex darken($percentage)
 * @method Hex spin($angle)
 * @method Hex greyscale()
 */
final class Hex extends AbstractColor implements ColorInterface
{
    /**
     * @var HexComponent
     */
    private $red;

    /**
     * @var HexComponent
     */
    private $green;

    /**
     * @var HexComponent
     */
    private $blue;

    /**
     * @param string $value
     */
    public function __construct($value = "")
    {
        list($red, $green, $blue) = $this->separateValues($value);
        $this->red = $this->createComponent($red);
        $this->green = $this->createComponent($green);
        $this->blue = $this->createComponent($blue);
    }

    private function separateValues($value)
    {
        $value = strtolower(trim(str_replace(" ", "", $value)));
        $value = ltrim($value, "#");
        if ("" === $value) {
            $value = "000";
        }
        $splitLength = 2;
        if (3 === strlen($value)) {
            $splitLength = 1;
        }

        return str_split($value, $splitLength);
    }

    private function createComponent($value)
    {
        return new HexComponent($value);
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return sprintf(
            "#%s%s%s",
            $this->getRed(),
            $this->getGreen(),
            $this->getBlue()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return "hex";
    }

    /**
     * @return HexComponent
     */
    public function getRed()
    {
        return $this->red;
    }

    /**
     * @return HexComponent
     */
    public function getGreen()
    {
        return $this->green;
    }

    /**
     * @return HexComponent
     */
    public function getBlue()
    {
        return $this->blue;
    }

    /**
     * {@inheritDoc}
     */
    public function getAlpha()
    {
        return new Alpha(1);
    }
}
