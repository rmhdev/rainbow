<?php

namespace Rainbow\Tests\Converter;

use Rainbow\Rgb;
use Rainbow\Converter\NullConverter;

class NullConverterTest extends \PHPUnit_Framework_TestCase
{
    public function testConvertColorShouldReturnEqualColor()
    {
        $color = new Rgb(10, 20, 30);
        $converter = new NullConverter($color);

        $this->assertEquals($color, $converter->convert());
    }
}
