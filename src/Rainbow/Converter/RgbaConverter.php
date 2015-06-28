<?php

namespace Rainbow\Converter;

use Rainbow\ColorInterface;
use Rainbow\Rgb;
use Rainbow\Rgba;

final class RgbaConverter implements ConverterInterface
{
    /**
     * @var Rgba
     */
    private $color;

    public function __construct(Rgba $color)
    {
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function toRgb()
    {
        return new Rgb(
            $this->getColor()->getRed(),
            $this->getColor()->getGreen(),
            $this->getColor()->getBlue()
        );
    }

    public function toHsl()
    {
        $converter = new RgbConverter($this->toRgb());

        return $converter->toHsl();
    }

    public static function create(ColorInterface $color)
    {
        if ($color instanceof Rgba) {
            return new self($color);
        }
        $className = sprintf('Rainbow\Converter\%sConverter', ucfirst($color->getName()));
        if (!class_exists($className)) {
            throw new \UnexpectedValueException("{$className} does not exist");
        }
        /* @var ConverterInterface $converter */
        $converter = new $className($color);
        $rgb = $converter->toRgb();

        return new self(
            new Rgba(
                $rgb->getRed(),
                $rgb->getGreen(),
                $rgb->getBlue(),
                $rgb->getAlpha()
            )
        );
    }
}
