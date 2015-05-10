<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Calculation\Channel;

use Rainbow\Rgb;
use Rainbow\Unit\Percent;
use Rainbow\Unit\RgbComponent;

abstract class AbstractLuminance
{
    /**
     * @var float
     */
    private $value;

    /**
     * @param Rgb $color
     */
    public function __construct(Rgb $color)
    {
        $red    = $this->calculateComponent($color->getRed());
        $green  = $this->calculateComponent($color->getGreen());
        $blue   = $this->calculateComponent($color->getBlue());

        $value = 0.2126 * $red + 0.7152 * $green + 0.0722 * $blue;

        $this->value = $value * 100;
    }

    /**
     * @param RgbComponent $component
     * @return float
     */
    private function calculateComponent(RgbComponent $component)
    {
        $component = $component->getValue();
        $component /= RgbComponent::MAX_VALUE;

        return $this->gammaCorrection($component);
    }

    /**
     * @param float $value
     * @return float
     */
    abstract protected function gammaCorrection($value);

    /**
     * @return Percent
     */
    public function result()
    {
        return new Percent($this->value);
    }
}
