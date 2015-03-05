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

final class NullTranslator implements TranslatorInterface
{
    /**
     * @param ColorInterface $color
     */
    public function __construct(ColorInterface $color)
    {
        $this->color = $color;
    }

    /**
     * Returns the same color
     * {@inheritDoc}
     */
    public function translate()
    {
        return $this->color->copy();
    }
}
