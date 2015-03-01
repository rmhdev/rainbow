<?php

namespace Rainbow\Translator;

use Rainbow\ColorInterface;

interface TranslatorInterface
{
    /**
     * Returns the translated color
     * @return ColorInterface
     */
    public function translate();
}
