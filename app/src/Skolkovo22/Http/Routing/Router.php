<?php

namespace Skolkovo22\Http\Routing;

use Skolkovo22\Http\Protocol\ClientMessageInterface;

class Router implements RouterInterface
{
    /**
     * @param CollectionInterface $collection
     */
    public function __construct(protected CollectionInterface $collection)
    {
    }
    
    /**
     * @param ClientMessageInterface $request
     *
     * @return RouteInterface
     *
     * @throws InvalidCollectionException
     * @throws RouteNotFoundException
     */
    public function handle(ClientMessageInterface $request): RouteInterface
    {
        if (empty($this->collection)) {
            throw new InvalidCollectionException('Collection of routes should not be empty');
        }
        
        foreach ($this->collection->getCollection() as $route) {
            if (!in_array($request->getMethod(), $route->getMethods(), true)) {
                continue;
            }
            
            if ($request->getPath() === $route->getRule()) {
                return $route;
            }
        }
        
        throw new RouteNotFoundException('Route not found');
    }
}
