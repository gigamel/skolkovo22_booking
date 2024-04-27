<?php

declare(strict_types=1);

namespace Skolkovo22\Http\Routing;

use Skolkovo22\Http\Protocol\ClientMessageInterface;

class Collection implements CollectionInterface
{
    /** @var RouteInterface[] */
    protected $collection = [];
    
    /**
     * @param string $name
     * @param string[] $methods
     * @param string $rule
     * @param string $action
     *
     * @throws InvalidRouteException
     */
    public function route(
        string $name,
        array $methods,
        string $rule,
        string $action
    ): void {
        $this->collection[] = new Route($name, $this->resolveMethods($methods), $rule, $action);
    }
    
    /**
     * @param string $name
     * @param string $rule
     * @param string $action
     *
     * @throws InvalidRouteException
     */
    public function get(string $name, string $rule, string $action): void
    {
        $this->route($name, [ClientMessageInterface::METHOD_GET], $rule, $action);
    }
    
    /**
     * @param string $name
     * @param string $rule
     * @param string $action
     *
     * @throws InvalidRouteException
     */
    public function post(string $name, string $rule, string $action): void
    {
        $this->route($name, [ClientMessageInterface::METHOD_POST], $rule, $action);
    }

    /**
     * @return RouteInterface[]
     */
    public function getCollection(): array
    {
        return $this->collection;
    }
    
    /**
     * @param array $methods
     *
     * @return string[]
     *
     * @throws InvalidRouteException
     */
    protected function resolveMethods(array $methods): array
    {
        if (empty($methods)) {
            throw new InvalidRouteException('Argument methods should not be empty');
        }
        
        foreach ($methods as $key => $method) {
            if (!is_string($method) || empty($method)) {
                throw new InvalidRouteException('Every HTTP method of argument should be type of string and not empty');
            }
            
            $normalizedMethod = strtoupper($method);
            if (!in_array($normalizedMethod, ClientMessageInterface::HTTP_METHODS, true)) {
                throw new InvalidRouteException(sprintf('Unsupported HTTP method %s', $method));
            }
            
            $methods[$key] = $normalizedMethod;
        }
        
        return $methods;
    }
}
