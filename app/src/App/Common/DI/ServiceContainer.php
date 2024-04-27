<?php

declare(strict_types=1);

namespace App\Common\DI;

use App\Common\Base\DIInterface;

class ServiceContainer implements DIInterface
{
    /** @var array */
    protected $dependencies = [];
    
    /**
     * @param string $id
     * @param mixed $dependency
     *
     * @return void
     */
    public function set(string $id, mixed $dependency): void
    {
        $this->dependencies[$id] = $dependency;
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function get(string $id): mixed
    {
        if (array_key_exists($id, $this->dependencies)) {
            return $this->dependencies[$id];
        }
        
        return null;
    }
}
