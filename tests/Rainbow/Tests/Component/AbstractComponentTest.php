<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Component;

use Rainbow\Component\Component;
use Rainbow\Component\ComponentInterface;

abstract class AbstractComponentTest extends \PHPUnit_Framework_TestCase
{
    public function testMaxValueShouldReturnValue()
    {
        $component = $this->createEmptyComponent();
        $this->assertEquals($this->expectedMaxValue(), $component::maxValue());
    }

    /**
     * @return ComponentInterface
     */
    abstract protected function createEmptyComponent();

    /**
     * @return mixed
     */
    abstract protected function expectedMaxValue();

    public function testCreateComponentWithMinValueShouldReturnMinComponent()
    {
        $this->assertEquals(
            new Component(0),
            Component::createComponent($this->createWithMinValue())
        );
    }

    public function testCreateComponentWithMaxValueShouldReturnMaxComponent()
    {
        $this->assertEquals(
            new Component(1),
            Component::createComponent($this->createWithMaxValue())
        );
    }

    /**
     * @return ComponentInterface
     */
    abstract protected function createWithMinValue();

    /**
     * @return ComponentInterface
     */
    abstract protected function createWithMaxValue();

    abstract public function testCreateComponentWithValueShouldReturnComponent();
}
