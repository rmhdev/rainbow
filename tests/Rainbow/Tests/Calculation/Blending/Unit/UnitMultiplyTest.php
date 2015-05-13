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

    public function testMultiplyWithMaxShouldReturnSameValue()
    {
        $component = new RgbComponent(100);
        $action = new UnitMultiply($component, new RgbComponent(RgbComponent::MAX_VALUE));

        $this->assertEquals($component, $action->result());
    }

    public function testMultiplyShouldReturnCorrectValue()
    {
        $component1 = new RgbComponent(100);
        $component2 = new RgbComponent(150);
        $expected = new RgbComponent(59);
        $action = new UnitMultiply($component1, $component2);

        $this->assertEquals($expected, $action->result());
    }
}
