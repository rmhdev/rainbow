<?php

namespace Rainbow\Unit;

final class Alpha
{
    private $value;

    public function __construct($value = 0)
    {
        $this->value = (float) $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}
