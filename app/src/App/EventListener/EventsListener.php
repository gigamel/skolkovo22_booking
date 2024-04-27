<?php

declare(strict_types=1);

namespace App\EventListener;

use Skolkovo22\EventListener\Listener;

final class EventsListener
{
    /** @var Listener */
    private static $listener;
    
    /**
     * @param string $event
     * @param callable $callable
     *
     * @return void
     */
    public static function on(string $event, callable $callable): void
    {
        self::getListener()->on($event, $callable);
    }

    /**
     * @param string $event
     * @param mixed ...$args
     *
     * @return void
     */
    public static function trigger(string $event, ...$args): void
    {
        self::getListener()->trigger($event, ...$args);
    }

    /**
     * @return Listener
     */
    private static function getListener(): Listener
    {
        if (is_null(self::$listener)) {
            self::$listener = new Listener();
        }

        return self::$listener;
    }
}
