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
use Rainbow\Rgb;

class ExclusionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider differenceDataProvider
     * @param Rgb $expected
     * @param Rgb $color
     */
    public function testColorShouldReturnCorrectColor(Rgb $expected, Rgb $color)
    {
        $baseColor = new Rgb(255, 102, 0);
        $operation = new Exclusion($baseColor, $color);

        $this->assertEquals($expected, $operation->result());
    }

    public function differenceDataProvider()
    {
        return array(
            array(new Rgb(255, 102, 0), new Rgb(0, 0, 0)),
            array(new Rgb(204, 112, 51), new Rgb(51, 51, 51)),
            array(new Rgb(153, 122, 102), new Rgb(102, 102, 102)),
            array(new Rgb(102, 133, 153), new Rgb(153, 153, 153)),
            array(new Rgb(51, 143, 204), new Rgb(204, 204, 204)),
            array(new Rgb(0, 153, 255), new Rgb(255, 255, 255)),
            array(new Rgb(0, 102, 0), new Rgb(255, 0, 0)),
            array(new Rgb(255, 153, 0), new Rgb(0, 255, 0)),
            array(new Rgb(255, 102, 255), new Rgb(0, 0, 255)),
        );
    }
}
