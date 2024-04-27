<?php

namespace Skolkovo22\DI;

interface ContainerInterface
{
    /**
     * @param string $id
     * @param mixed $dependency
     *
     * @return void
     */
    public function put(string $id, mixed $dependency): void;
    
    /**
     * @param string $id
     *
     * @return mixed
     *
     * @throws DependencyNotFundException
     */
    public function get(string $id): mixed;
}
