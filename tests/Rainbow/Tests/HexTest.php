<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests;

use Rainbow\Hex;
use Rainbow\Unit\Alpha;
use Rainbow\Unit\HexComponent;

class HexTest extends \PHPUnit_Framework_TestCase
{
    public function testGetNameShouldReturnConstName()
    {
        $color = new Hex();

        $this->assertEquals("hex", $color->getName());
    }

    public function testDefaultColorShouldBeBlack()
    {
        $color = new Hex();

        $this->assertEquals("#000000", (string)$color);
    }

    /**
     * @dataProvider correctInputDataProvider
     * @param $expected
     * @param $text
     */
    public function testCorrectInputShouldCreateColor($expected, $text)
    {
        $color = new Hex($text);

        $this->assertEquals($expected, (string)$color);
    }

    public function correctInputDataProvider()
    {
        return array(
            array("#123456", "123456"),
            array("#000000", " "),
            array("#123456", " 12 34 56"),
            array("#123abc", "123ABC"),
            array("#aabbcc", "abc"),
        );
    }

    public function testColorShouldReturnDefinedValues()
    {
        $color = new Hex("#11aa33");

        $this->assertEquals(new HexComponent("11"), $color->getRed());
        $this->assertEquals(new HexComponent("aa"), $color->getGreen());
        $this->assertEquals(new HexComponent("33"), $color->getBlue());
    }

    public function testAlphaShouldReturnTotalOpacity()
    {
        $color = new Hex("#112233");
        $alpha = new Alpha(1);

        $this->assertEquals($alpha, $color->getAlpha());
    }
}
