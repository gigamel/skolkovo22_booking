<?php

namespace App\Common\Base;

interface DIHydrator
{
    /**
     * @param DIInterface $di
     *
     * @return void
     */
    public function hydrate(DIInterface $di): void;
}
