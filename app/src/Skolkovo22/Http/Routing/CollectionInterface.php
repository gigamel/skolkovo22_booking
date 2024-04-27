<?php

namespace Skolkovo22\Http\Routing;

interface CollectionInterface
{
    /**
     * @return RouteInterface[]
     */
    public function getCollection(): array;
}
