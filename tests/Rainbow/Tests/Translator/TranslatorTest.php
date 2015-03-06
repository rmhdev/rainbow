<?php

namespace Rainbow\Tests\Translator;

use Rainbow\Translator\Translator;
use Rainbow\Hsl;

class TranslatorTest extends \PHPUnit_Framework_TestCase
{
    public function testToRgbShouldReturnRgb()
    {
        $converter = new Translator(new Hsl(0, 0, 0));

        $this->assertInstanceOf('Rainbow\Rgb', $converter->toRgb());
    }
}
