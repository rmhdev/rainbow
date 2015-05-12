<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Calculation\Blending;

use Rainbow\Calculation\CalculationInterface;
use Rainbow\Rgb;

final class Screen implements CalculationInterface
{
    /**
     * @var Rgb
     */
    private $result;

    /**
     * @param Rgb $color1
     * @param Rgb $color2
     */
    public function __construct(Rgb $color1, Rgb $color2)
    {
        $redSum     = $color1->getRed()->getValue() + $color2->getRed()->getValue() ;
        $greenSum   = $color1->getGreen()->getValue() + $color2->getGreen()->getValue();
        $blueSum    = $color1->getBlue()->getValue() + $color2->getBlue()->getValue();
        $multiply   = new Multiply($color1, $color2);
        $multiplied = $multiply->result();

        $this->result = new Rgb(
            abs($redSum - $multiplied->getRed()->getValue()),
            abs($greenSum - $multiplied->getGreen()->getValue()),
            abs($blueSum - $multiplied->getBlue()->getValue())
        );
    }

    /**
     * @return Rgb
     */
    public function result()
    {
        return $this->result->copy();
    }
}
