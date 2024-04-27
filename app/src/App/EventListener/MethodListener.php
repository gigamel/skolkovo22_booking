<?php

declare(strict_types=1);

namespace App\EventListener;

use Skolkovo22\EventListener\Listener;

final class MethodListener
{
    /** @var Listener */
    private static $listener;
    
    /**
     * @return Listener
     */
    public static function getListener(): Listener
    {
        if (is_null(self::$listener)) {
            self::$listener = new Listener();
        }
        
        return self::$listener;
    }
    
    /**
     * @param string $className
     * @param string $method
     * @param callable $callable
     *
     * @return void
     */
    public static function onCall(string $className, string $method, callable $callable): void
    {
        self::getListener()->on(self::getEventName($className, $method), $callable);
    }
    
    /**
     * @param string $className
     * @param string $method
     * @param mixed ...$args
     *
     * @return void
     */
    public static function call(string $className, string $method, ...$args): void
    {
        self::getListener()->trigger(self::getEventName($className, $method), ...$args);
    }
    
    /**
     * @param string $className
     * @param string $method
     *
     * @return string
     */
    private static function getEventName(string $className, string $method): string
    {
        return sprintf('%s::%s', $className, $method);
    }
}
