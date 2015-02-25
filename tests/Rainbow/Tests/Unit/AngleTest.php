<?php

namespace Rainbow\Tests\Unit;

use Rainbow\Unit\Angle;

class AngleTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyShouldReturnZero()
    {
        $angle = new Angle();

        $this->assertEquals(0, $angle->getValue());
    }
}
