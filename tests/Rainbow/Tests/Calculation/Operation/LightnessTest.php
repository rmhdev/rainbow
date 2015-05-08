<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Calculation\Operation;

use Rainbow\Calculation\Operation\Lightness;
use Rainbow\Hsl;
use Rainbow\Unit\Percent;

class LightnessTest extends \PHPUnit_Framework_TestCase
{
    public function testLightnessShouldReturnUpdatedPercent()
    {
        $color = new Hsl(180, 50, 0);
        $operation = new Lightness($color, 10);
        $lightness = $operation->result();

        $this->assertEquals(new Percent(10), $lightness);
    }

    public function testLightnessShouldBeLesserEqualThan100()
    {
        $color = new Hsl(180, 50, 80);
        $operation = new Lightness($color, 30);

        $this->assertEquals(new Percent(100), $operation->result());
    }

    public function testLightnessShouldBeGreaterEqualThanZero()
    {
        $color = new Hsl(180, 50, 20);
        $operation = new Lightness($color, -30);

        $this->assertEquals(new Percent(0), $operation->result());
    }

    public function testEmptyDifferenceShouldReturnEqualColor()
    {
        $color = new Hsl(180, 50, 20);
        $operation = new Lightness($color);

        $this->assertEquals(new Percent(20), $operation->result());
    }
}
