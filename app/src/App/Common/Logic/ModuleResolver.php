<?php

declare(strict_types=1);

namespace App\Common\Logic;

use App\Http\Request;
use Skolkovo22\Http\Routing\CollectionInterface;
use Skolkovo22\Http\Routing\InvalidCollectionException;
use Skolkovo22\Http\Routing\RouteInterface;
use Skolkovo22\Http\Routing\RouteNotFoundException;
use Skolkovo22\Http\Routing\Router;

final class ModuleResolver
{
    /**
     * @param CollectionInterface $collection
     *
     * @return RouteInterface
     *
     * @throws ModuleNotFoundException
     */
    public function resolve(CollectionInterface $collection): RouteInterface
    {
        try {
            return (new Router($collection))->handle(new Request());
        } catch (InvalidCollectionException | RouteNotFoundException $e) {
            throw new ModuleNotFoundException('Module not found');
        }
    }
}
