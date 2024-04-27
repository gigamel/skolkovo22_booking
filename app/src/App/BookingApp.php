<?php

declare(strict_types=1);

namespace App;

use App\Common\Logic\DriversLoader;
use App\Common\Logic\ModuleConfigurator;
use App\Common\Logic\ModuleLauncher;
use App\Common\Logic\ModuleResolver;
use App\EventListener\MethodListener;
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
        $this->configuration();
        $route = $this->routing();

        $this->moduleConfiguration($route);

        $this->accessChecking();
        $this->moduleDriversLoading();
        $this->moduleRunning();
    }

    /**
     * @return void
     */
    private function configuration(): void
    {
        $appConfig = require_once($this->getConfigDirectory() . '/app.php');

        MethodListener::onCall(
            Module::class,
            'run',
            function (EstateCollection $collection) {
                foreach ($collection->getCollection() as $estate) {
                    $estate->title = $estate->title . ' handled from ' . __FILE__ . '::' . __LINE__;
                }
            }
        );
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
     * @return void
     */
    private function moduleConfiguration(RouteInterface $route): void
    {
        $moduleConfigurator = new ModuleConfigurator($route);
        $response = $moduleConfigurator->getConfiguredModule()->run();
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
