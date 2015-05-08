<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Calculation\Operation;

use Rainbow\Hsl;

final class Saturation
{
    private $color;
    private $saturation;

    /**
     * @param Hsl $color
     * @param int $difference
     */
    public function  __construct(Hsl $color, $difference = 0)
    {
        $this->color = $color;
        $this->saturation = $this->calculateNewSaturation($difference);
    }

    private function calculateNewSaturation($difference)
    {
        $saturation = $this->color->getSaturation()->getValue();
        if (!$difference) {
            return $saturation;
        }
        if ($difference < 0) {
            return max($saturation + $difference, 0);
        }

        return min($saturation + $difference, 100);
    }

    /**
     * @return Hsl
     */
    public function result()
    {
        return new Hsl(
            $this->color->getHue()->getValue(),
            $this->saturation,
            $this->color->getLightness()->getValue()
        );
    }
}
