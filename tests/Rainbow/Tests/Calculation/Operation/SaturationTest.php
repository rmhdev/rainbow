<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Calculation\Operation;

use Rainbow\Calculation\Operation\Saturation;
use Rainbow\Hsl;
use Rainbow\Unit\Percent;

class SaturationTest extends \PHPUnit_Framework_TestCase
{
    public function testSaturationShouldReturnNewColor()
    {
        $color = new Hsl(180, 0, 50);
        $saturation = new Saturation($color, 10);
        $newColor = $saturation->result();

        $this->assertInstanceOf('Rainbow\Hsl', $newColor);
        $this->assertEquals(new Percent(0), $color->getSaturation());
        $this->assertEquals(new Percent(10), $newColor->getSaturation());
    }

    public function testSaturationShouldBeLesserEqualThan100()
    {
        $color = new Hsl(180, 80, 50);
        $saturation = new Saturation($color, 30);

        $this->assertEquals(new Percent(100), $saturation->result()->getSaturation());
    }

    public function testSaturationShouldBeGreaterEqualThanZero()
    {
        $color = new Hsl(180, 20, 50);
        $saturation = new Saturation($color, -30);

        $this->assertEquals(new Percent(0), $saturation->result()->getSaturation());
    }

    public function testEmptyDifferenceShouldReturnEqualColor()
    {
        $color = new Hsl(180, 20, 50);
        $saturation = new Saturation($color);

        $this->assertEquals($color, $saturation->result());
    }
}
