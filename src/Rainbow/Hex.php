<?php

namespace Rainbow;

final class Hex
{
    private $value;

    function __construct($value = "")
    {
        $this->value = $this->processColorValue($value);
    }

    private function processColorValue($value = "")
    {
        $value = strtolower(trim(str_replace(" ", "", $value)));
        if ("" === $value) {
            return "#000000";
        }
        if (false === strpos($value, "#")) {
            $value = sprintf("#%s", $value);
        }

        return $value;
    }


    public function __toString()
    {
        return $this->value;
    }

    public function getName()
    {
        return "hex";
    }
}
