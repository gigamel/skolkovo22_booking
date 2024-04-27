<?php

declare(strict_types=1);

namespace App;

use App\Common\Base\DIInterface;
use App\Common\DI\ServiceContainer;
use App\Common\Loader\DriversLoader;
use App\Common\Configurator\ModuleConfigurator;
use App\Common\Launcher\ModuleLauncher;
use App\Common\Resolver\ModuleResolver;
use App\EventListener\EventsListener;
use App\Security\UserAccessChecker;
use Modules\Skolkovo22\Booking\Entity\EstateCollection;
use Modules\Skolkovo22\Booking\Module;
use Skolkovo22\Http\Routing\Collection;
use Skolkovo22\Http\Routing\RouteInterface;

final class BookingApp
{
    /**
     * @param string $baseDirectory
     */
    public function __construct(private string $baseDirectory)
    {
    }

    /**
     * @return void
     */
    public function run(): void
    {
        try {
            $this->mainProcess();
        } catch (\Throwable $e) {
            $this->exceptionProcess($e);
        }
    }

    /**
     * @param \Throwable $e
     *
     * @return void
     */
    private function exceptionProcess(\Throwable $e): void
    {
        echo sprintf(
            "File: %s:%d<br>Message: %s<br>Trace:<br><pre>%s</pre>",
            $e->getFile(),
            $e->getLine(),
            $e->getMessage(),
            $e->getTraceAsString()
        );
    }

    /**
     * @return void
     */
    private function mainProcess(): void
    {
        $di = $this->configuration();
        $route = $this->routing();

        $this->moduleConfiguration($route, $di);

        $this->accessChecking();
        $this->moduleDriversLoading();
        $this->moduleRunning();
    }

    /**
     * @return DIInterface
     */
    private function configuration(): DIInterface
    {
        $appConfig = require_once($this->getConfigDirectory() . '/app.php');

        EventsListener::on(
            'skolkovo22.get.estates',
            function (EstateCollection $collection) {
                foreach ($collection->getCollection() as $estate) {
                    $estate->summary = $estate->summary . ' (handled from ' . __FILE__ . '::' . __LINE__ . ')';
                }
            }
        );

        $di = new ServiceContainer();
        return $di;
    }

    /**
     * @return RouteInterface
     */
    private function routing(): RouteInterface
    {
        $routes = new Collection();
        require_once($this->getConfigDirectory() . '/routes.php');

        $resolver = new ModuleResolver();
        return $resolver->resolve($routes);
    }

    /**
     * @return void
     */
    private function accessChecking(): void
    {
        $userAccessChecker = new UserAccessChecker();
    }

    /**
     * @param RouteInterface $route
     * @param DIInterface $di
     *
     * @return void
     */
    private function moduleConfiguration(RouteInterface $route, DIInterface $di): void
    {
        $configurator = (new ModuleConfigurator($route));
        $response = $configurator->getConfiguredModule($di)->run();
        $response->send();
        echo $response->getBody();
    }

    /**
     * @return void
     */
    private function moduleDriversLoading(): void
    {
        $extensionsLoader = new DriversLoader();
    }

    /**
     * @return void
     */
    private function moduleRunning(): void
    {
        $moduleRunner = new ModuleLauncher();
    }

    /**
     * @return string
     */
    private function getConfigDirectory(): string
    {
        return $this->baseDirectory . '/config';
    }
}
