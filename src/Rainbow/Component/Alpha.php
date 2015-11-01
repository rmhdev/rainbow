<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Component;

final class Alpha implements ComponentInterface
{
    private $component;

    /**
     * @param int|number $value
     */
    public function __construct($value = Component::MAX_VALUE)
    {
        $this->component = new Component($value);
    }

    /**
     * {@inheritDoc}
     */
    public function getValue()
    {
        return $this->component->getValue();
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return (string) $this->component;
    }

    /**
     * {@inheritDoc}
     * @return float
     */
    public static function maxValue()
    {
        return Component::maxValue();
    }
}
