<?php

namespace Rainbow\Tests;

abstract class AbstractColorTest extends \PHPUnit_Framework_TestCase
{
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
}
