<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Tests\Component;

use Rainbow\Component\Alpha;

/**
 * Alpha uses Component; it's unnecessary to add extra tests already covered with Component's own.
 *
 * Class AlphaTest
 * @package Rainbow\Tests\Component
 */
class AlphaTest extends AbstractComponentTest
{
    public function testEmptyShouldReturnZero()
    {
        $component = $this->createEmptyComponent();

        $this->assertEquals(1, $component->getValue());
        $this->assertInternalType("float", $component->getValue());
    }

    protected function createEmptyComponent()
    {
        return new Alpha();
    }
}
