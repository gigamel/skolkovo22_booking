<?php

namespace App\Common\Loader;

use App\Common\Base\DIInterface;

interface DILoaderInterface
{
    /**
     * @param DIInterface $di
     *
     * @return void
     */
    public function loadServices(DIInterface $di): void;
}
