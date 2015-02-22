<?php

namespace Rainbow\Unit;

interface UnitInterface
{
    /**
     * @return number
     */
    public function getValue();

    /**
     * @return string
     */
    public function __toString();
}
