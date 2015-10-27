<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Calculation\Blending;

use Rainbow\Calculation\Blending\Exclusion;
use Rainbow\Rgba;

class ExclusionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider differenceDataProvider
     * @param Rgba $expected
     * @param Rgba $color
     */
    public function testColorShouldReturnCorrectColor(Rgba $expected, Rgba $color)
    {
        $baseColor = new Rgba(255, 102, 0, 1);
        $operation = new Exclusion($baseColor, $color);

        $this->assertEquals($expected, $operation->result());
    }

    public function differenceDataProvider()
    {
        return array(
            array(new Rgba(255, 102, 0, 1), new Rgba(0, 0, 0, 1)),
            array(new Rgba(204, 112, 51, 1), new Rgba(51, 51, 51, 1)),
            array(new Rgba(153, 122, 102, 1), new Rgba(102, 102, 102, 1)),
            array(new Rgba(102, 133, 153, 1), new Rgba(153, 153, 153, 1)),
            array(new Rgba(51, 143, 204, 1), new Rgba(204, 204, 204, 1)),
            array(new Rgba(0, 153, 255, 1), new Rgba(255, 255, 255, 1)),
            array(new Rgba(0, 102, 0, 1), new Rgba(255, 0, 0, 1)),
            array(new Rgba(255, 153, 0, 1), new Rgba(0, 255, 0, 1)),
            array(new Rgba(255, 102, 255, 1), new Rgba(0, 0, 255, 1)),
        );
    }
}
