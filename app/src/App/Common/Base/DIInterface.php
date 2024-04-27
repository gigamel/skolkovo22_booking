<?php

namespace App\Common\Base;

interface DIInterface
{
    /**
     * @param string $id
     * @param mixed $dependency
     *
     * @return void
     */
    public function set(string $id, mixed $dependency): void;
    
    /**
     * @param string $id
     *
     * @return mixed
     */
    public function get(string $id): mixed;
}
