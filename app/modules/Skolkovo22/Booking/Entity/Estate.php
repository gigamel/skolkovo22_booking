<?php

declare(strict_types=1);

namespace Modules\Skolkovo22\Booking\Entity;

final class Estate
{
    /**
     * @param string $title
     * @param string $summary
     */
    public function __construct(public string $title, public string $summary)
    {
    }
}
