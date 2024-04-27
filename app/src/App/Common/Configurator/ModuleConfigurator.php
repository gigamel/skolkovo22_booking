<?php

declare(strict_types=1);

namespace App\Common\Configurator;

use App\Common\AbstractModule;
use App\Template\RendererEngine;
use Skolkovo22\Http\Routing\RouteInterface;

final class ModuleConfigurator
{
    /**
     * @param RouteInterface $route
     */
    public function __construct(private RouteInterface $route)
    {
    }
 
    /**
     * @return void
     */
    public function loadConfig(): void
    {
    }
    
    /**
     * @return void
     */
    public function registerEvents(): void
    {
    }
    
    /**
     * @return void
     */
    public function loadDrivers(): void
    {
    }
    
    /**
     * @return AbstractModule
     */
    public function getConfiguredModule(): AbstractModule
    {
        $moduleClass = $this->getModuleClass();
        if (!is_a($moduleClass, AbstractModule::class, true)) {
            throw new \RuntimeException(sprintf('Invalid module class %s', $moduleClass));
        }
        
        $module = new $moduleClass();
        $module->setDir(dirname((new \ReflectionClass($moduleClass))->getFileName()));
        $module->setTemplateRenderer(new RendererEngine());
        return $module;
    }
    
    /**
     * @return string
     */
    private function getModuleClass(): string
    {
        return 'Modules\\' . implode(
            '\\',
            array_map(
                'ucfirst',
                explode('.', $this->route->getAction())
            )
        ) . '\\Module';
    }
}
