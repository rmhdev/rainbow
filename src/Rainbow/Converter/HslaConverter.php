<?php

/**
 * This file is part of the Rainbow package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace Rainbow\Converter;

use Rainbow\ColorInterface;
use Rainbow\Hsl;
use Rainbow\Hsla;

final class HslaConverter
{
    private $color;

    public function __construct(Hsla $color)
    {
        $this->color = $color;
    }

    public function getColor()
    {
        return clone $this->color;
    }

    public function toHsl()
    {
        return new Hsl(
            $this->getColor()->getHue(),
            $this->getColor()->getSaturation(),
            $this->getColor()->getLightness()
        );
    }

    public function toRgb()
    {
        $converter = new HslConverter($this->toHsl());

        return $converter->toRgb();
    }

    /**
     * {@inheritDoc}
     * @return HslaConverter
     */
    public static function create(ColorInterface $color)
    {
        if ($color instanceof Hsla) {
            return new self($color);
        }
        $className = sprintf('Rainbow\Converter\%sConverter', ucfirst($color->getName()));
        if (!class_exists($className)) {
            throw new \UnexpectedValueException("{$className} does not exist");
        }
        /* @var ConverterInterface $converter */
        $converter = new $className($color);
        $hslConverter = new HslConverter($converter->toHsl());
        $hsl = $hslConverter->getColor();

        return new HslaConverter(new Hsla(
            $hsl->getHue(),
            $hsl->getSaturation(),
            $hsl->getLightness(),
            $color->getAlpha()
        ));
    }
}
