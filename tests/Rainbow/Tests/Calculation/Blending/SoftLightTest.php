<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Calculation\Blending;

use Rainbow\Calculation\Blending\SoftLight;
use Rainbow\Rgba;

class SoftLightTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider overlayDataProvider
     * @param Rgba $expected
     * @param Rgba $color
     */
    public function testColorShouldReturnCorrectColor(Rgba $expected, Rgba $color)
    {
        $baseColor = new Rgba(255, 102, 0, 1);
        $overlay = new SoftLight($baseColor, $color);

        $this->assertEquals($expected, $overlay->result());
    }

    public function overlayDataProvider()
    {
        return array(
            array(new Rgba(255, 41, 0, 1), new Rgba(0, 0, 0, 1)),
            array(new Rgba(255, 65, 0, 1), new Rgba(51, 51, 51, 1)),
            array(new Rgba(255, 90, 0, 1), new Rgba(102, 102, 102, 1)),
            array(new Rgba(255, 114, 0, 1), new Rgba(153, 153, 153, 1)),
            array(new Rgba(255, 138, 0, 1), new Rgba(204, 204, 204, 1)),
            array(new Rgba(255, 161, 0, 1), new Rgba(255, 255, 255, 1)),
            array(new Rgba(255, 41, 0, 1), new Rgba(255, 0, 0, 1)),
            array(new Rgba(255, 161, 0, 1), new Rgba(0, 255, 0, 1)),
            array(new Rgba(255, 41, 0, 1), new Rgba(0, 0, 255, 1)),
        );
    }
}
