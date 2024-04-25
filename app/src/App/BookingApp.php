<?php

declare(strict_types=1);

namespace App;

use App\Runtime\ExtesionsLoader;
use App\Runtime\ModuleRunner;
use App\Security\UserAccessChecker;

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
            echo $e->getMessage();
        }
    }

    /**
     * @return void
     */
    private function mainProcess(): void
    {
        $this->configuration();
        $this->routing();
        $this->accessChecking();
        $this->moduleExtensionsLoading();
        $this->moduleRunning();
    }

    /**
     * @return void
     */
    private function configuration(): void
    {
        $appConfig = require_once($this->getConfigDirectory() . '/app.php');
    }

    /**
     * @return void
     */
    private function routing(): void
    {
        // Todo
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
    private function moduleExtensionsLoading(): void
    {
        $extensionsLoader = new ExtesionsLoader();
    }

    /**
     * @return void
     */
    private function moduleRunning(): void
    {
        $moduleRunner = new ModuleRunner();
    }

    /**
     * @return string
     */
    private function getConfigDirectory(): string
    {
        return $this->baseDirectory . '/config';
    }
}
