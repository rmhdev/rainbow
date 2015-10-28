<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Unit;

use Rainbow\Unit\UnitInterface;

abstract class AbstractUnitTest extends \PHPUnit_Framework_TestCase
{
    public function testMaxValueShouldReturnValue()
    {
        $unit = $this->createEmptyUnit();
        $this->assertEquals($this->expectedMaxValue(), $unit::maxValue());
    }

    /**
     * @return UnitInterface
     */
    abstract protected function createEmptyUnit();

    /**
     * @return mixed
     */
    abstract protected function expectedMaxValue();
}
