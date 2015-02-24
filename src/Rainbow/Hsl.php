<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow;

use Rainbow\Unit\Percent;

final class Hsl
{
    public function getHue()
    {
        return 0;
    }

    public function getSaturation()
    {
        return new Percent(0);
    }

    public function getLightness()
    {
        return new Percent(0);
    }
}
