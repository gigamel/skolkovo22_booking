<?php

declare(strict_types=1);

namespace Modules\Skolkovo22\Booking\Entity;

final class EstateCollection
{
    /** @var Estate[] */
    private $estates = [];
    
    /**
     * @param Estate $estate
     *
     * @return void
     */
    public function put(Estate $estate): void
    {
        $this->estates[] = $estate;
    }
    
    /**
     * @return Estate[]
     */
    public function getCollection(): array
    {
        return $this->estates;
    }
}
