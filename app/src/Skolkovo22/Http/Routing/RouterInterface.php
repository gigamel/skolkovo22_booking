<?php

namespace Skolkovo22\Http\Routing;

use Skolkovo22\Http\Protocol\ClientMessageInterface;

interface RouterInterface
{
    /**
     * @param ClientMessageInterface $request
     *
     * @return string
     */
    public function handle(ClientMessageInterface $request): string;
}
