<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Converter;

use Rainbow\Hex;
use Rainbow\Hsl;
use Rainbow\Rgb;

abstract class AbstractConverterTest extends \PHPUnit_Framework_TestCase
{
    private $equivalences = null;

    private function equivalences()
    {
        if (!$this->equivalences) {
            $this->equivalences = $this->baseEquivalences();
        }

        return $this->equivalences;
    }

    private function baseEquivalences()
    {
        return array(
            array(
                "hex"   => new Hex("000000"),
                "rgb"   => new Rgb(0, 0, 0),
                "hsl"   => new Hsl(0, 0, 0),
            ),
            array(
                "hex"   => new Hex("#ff0000"),
                "rgb"   => new Rgb(255, 0, 0),
                "hsl"   => new Hsl(0, 100, 50),
            ),
            array(
                "hex"   => new Hex("#00ff00"),
                "rgb"   => new Rgb(0, 255, 0),
                "hsl"   => new Hsl(120, 100, 50),
            ),
            array(
                "hex"   => new Hex("#0000ff"),
                "rgb"   => new Rgb(0, 0, 255),
                "hsl"   => new Hsl(240, 100, 50),
            ),
            array(
                "hex"   => new Hex("#ffffff"),
                "rgb"   => new Rgb(255, 255, 255),
                "hsl"   => new Hsl(0, 0, 100),
            ),
            array(
                "hex"   => new Hex("#ff00ff"),
                "rgb"   => new Rgb(255, 0, 255),
                "hsl"   => new Hsl(300, 100, 50),
            ),
            array(
                "hex"   => new Hex("#008000"),
                "rgb"   => new Rgb(0, 128, 0),
                "hsl"   => new Hsl(120, 100, 25),
            ),
            array(
                "hex"   => new Hex("#ff8000"),
                "rgb"   => new Rgb(255, 128, 0),
                "hsl"   => new Hsl(30, 100, 50),
            ),
            array(
                "hex"   => new Hex("#0080ff"),
                "rgb"   => new Rgb(0, 128, 255),
                "hsl"   => new Hsl(210, 100, 50),
            ),
            array(
                "hex"   => new Hex("#80e61a"),
                "rgb"   => new Rgb(128, 230, 26),
                "hsl"   => new Hsl(90, 80, 50),
            )
        );
    }

    /**
     * @param string $colorNameA
     * @param string $colorNameB
     * @return array
     */
    protected function getEquivalences($colorNameA, $colorNameB)
    {
        return array_map(
            function ($item) use ($colorNameA, $colorNameB) {
                return array($item[$colorNameA], $item[$colorNameB]);
            },
            $this->equivalences()
        );
    }
}
