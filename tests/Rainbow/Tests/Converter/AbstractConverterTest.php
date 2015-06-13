<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Converter;

use Rainbow\Hsl;
use Rainbow\Rgb;

abstract class AbstractConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function getRgbHslEquivalenceDataProvider()
    {
        return array(
            array(
                array("red" => 0, "green" => 0, "blue" => 0),
                array("hue" => 0, "saturation" => 0, "lightness" => 0)
            ),
            array(
                array("red" => 255, "green" => 0, "blue" => 255),
                array("hue" => 300, "saturation" => 100, "lightness" => 50)
            ),
            array(
                array("red" => 0, "green" => 128, "blue" => 0),
                array("hue" => 120, "saturation" => 100, "lightness" => 25)
            ),
            array(
                array("red" => 255, "green" => 128, "blue" => 0),
                array("hue" => 30, "saturation" => 100, "lightness" => 50)
            ),
            array(
                array("red" => 0, "green" => 128, "blue" => 255),
                array("hue" => 210, "saturation" => 100, "lightness" => 50)
            ),
            array(
                array("red" => 128, "green" => 230, "blue" => 26),
                array("hue" => 90, "saturation" => 80, "lightness" => 50)
            ),
        );
    }

    /**
     * @param array $values
     * @return Rgb
     */
    public function createRgb($values)
    {
        return new Rgb(
            $values["red"],
            $values["green"],
            $values["blue"]
        );
    }

    /**
     * @param array $values
     * @return Hsl
     */
    public function createHsl($values)
    {
        return new Hsl(
            $values["hue"],
            $values["saturation"],
            $values["lightness"]
        );
    }

    public function hslRgbEquivalences()
    {
        return array(
            array(new Hsl(0, 0, 0), new Rgb(0, 0, 0)),
            array(new Hsl(300, 100, 50), new Rgb(255, 0, 255)),
            array(new Hsl(120, 100, 25), new Rgb(0, 128, 0)),
            array(new Hsl(30, 100, 50), new Rgb(255, 128, 0)),
            array(new Hsl(210, 100, 50), new Rgb(0, 128, 255)),
            array(new Hsl(90, 80, 50), new Rgb(128, 230, 26)),
        );
    }

    public function rgbHslEquivalences()
    {
        return array_map(
            function ($item) {
                return array_reverse($item);
            },
            $this->hslRgbEquivalences()
        );
    }
}
