<?php

namespace Rainbow\Tests\Calculation\Blending\Unit;

use Rainbow\Calculation\Blending\Unit\UnitMultiply;
use Rainbow\Unit\RgbComponent;

class UnitMultiplyTest extends \PHPUnit_Framework_TestCase
{
    public function testMultiplyWithMinShouldReturnMin()
    {
        $component = new RgbComponent(100);
        $min = new RgbComponent(0);
        $action = new UnitMultiply($component, $min);

        $this->assertEquals($min, $action->result());
    }
}
