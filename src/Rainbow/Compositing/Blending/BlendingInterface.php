<?php

namespace Rainbow\Compositing\Blending;

use Rainbow\Rgba;

interface BlendingInterface
{
    /**
     * BlendingInterface constructor.
     * @param Rgba $backdrop
     * @param Rgba $source
     */
    public function __construct(Rgba $backdrop, Rgba $source);

    /**
     * @return Rgba
     */
    public function result();
}
