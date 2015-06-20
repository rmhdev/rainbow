<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Translator;

use Rainbow\ColorInterface;
use Rainbow\Rgb;
use Rainbow\Hsl;

final class Translator
{
    private $color;

    /**
     * @param ColorInterface $color  A color to translate
     */
    public function __construct(ColorInterface $color)
    {
        $this->color = $color;
    }

    /**
     * @return Rgb
     */
    public function toRgb()
    {
        return $this->to("rgb");
    }

    private function getColor()
    {
        return $this->color;
    }

    /**
     * @return Hsl
     */
    public function toHsl()
    {
        return $this->to("hsl");
    }

    /**
     * @param string $name name of the expected color
     * @return ColorInterface
     */
    public function to($name)
    {
        $className = sprintf('Rainbow\Converter\%sConverter', ucfirst($name));
        if (!class_exists($className)) {
            throw new \UnexpectedValueException("Class {$className} does not exist");
        }
        $converter = $className::create($this->getColor());

        return $converter->getColor();
    }
}
