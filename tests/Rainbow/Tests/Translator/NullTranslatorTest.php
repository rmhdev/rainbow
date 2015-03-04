<?php

namespace Rainbow\Tests\Translator;

use Rainbow\Rgb;
use Rainbow\Translator\NullTranslator;

class NullTranslatorTest extends \PHPUnit_Framework_TestCase
{
    public function testTranslateColorShouldReturnEqualColor()
    {
        $color = new Rgb(10, 20, 30);
        $translator = new NullTranslator($color);

        $this->assertEquals($color, $translator->translate());
    }
}
