<?php

declare(strict_types=1);

namespace Skolkovo22\EventListener;

class Listener
{
    /** @var array */
    protected $listeners = [];
    
    /**
     * @param string $event
     * @param callable $eventHandler
     *
     * @return void
     */
    public function on(string $event, callable $eventHandler): void
    {
        if (!array_key_exists($event, $this->listeners)) {
            $this->listeners[$event] = [];
        }
        
        $this->listeners[$event][] = $eventHandler;
    }
    
    /**
     * @param string $event
     * @param mixed ...$args
     *
     * @return void
     */
    public function trigger(string $event, ...$args): void
    {
        if (array_key_exists($event, $this->listeners)) {
            foreach ($this->listeners[$event] as $eventHandler) {
                call_user_func($eventHandler, ...$args);
            }
        }
    }
}
