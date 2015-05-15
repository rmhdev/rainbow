<?php

namespace Rainbow;

use Rainbow\Unit\HexComponent;

final class Hex
{
    /**
     * @var HexComponent
     */
    private $red;

    /**
     * @var HexComponent
     */
    private $green;

    /**
     * @var HexComponent
     */
    private $blue;

    /**
     * @param string $value
     */
    function __construct($value = "")
    {
        list($red, $green, $blue) = $this->separateValues($value);
        $this->red = $this->createComponent($red);
        $this->green = $this->createComponent($green);
        $this->blue = $this->createComponent($blue);
    }

    private function separateValues($value)
    {
        $value = strtolower(trim(str_replace(" ", "", $value)));
        if (false !== strpos($value, "#")) {
            $value = str_replace("#", "", $value);
        }
        if ("" === $value) {
            $value = "000";
        }
        $splitLength = 2;
        if (3 === strlen($value)) {
            $splitLength = 1;
        }

        return str_split($value, $splitLength);
    }

    private function createComponent($value)
    {
        return new HexComponent($value);
    }

    public function __toString()
    {
        return sprintf("#%s%s%s",
            $this->red,
            $this->green,
            $this->blue
        );
    }

    public function getName()
    {
        return "hex";
    }
}
