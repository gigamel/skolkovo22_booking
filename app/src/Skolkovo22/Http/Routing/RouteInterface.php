<?php

declare(strict_types=1);

namespace Skolkovo22\Http\Routing;

interface RouteInterface
{
    /**
     * @return string
     */
    public function getName(): string;
    
    /**
     * @return string
     */
    public function getRule(): string;
    
    /**
     * @return string
     */
    public function getAction(): string;
    
    /**
     * @return string[]
     */
    public function getMethods(): array;
}
