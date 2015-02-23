<?php

namespace Rainbow\Tests\Unit;

use Rainbow\Unit\Alpha;

class AlphaTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyShouldReturnZero()
    {
        $unit = new Alpha();

        $this->assertEquals(0, $unit->getValue());
    }
}
