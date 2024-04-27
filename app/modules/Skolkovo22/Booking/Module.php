<?php

declare(strict_types=1);

namespace Modules\Skolkovo22\Booking;

use App\Common\AbstractModule;
use App\EventListener\MethodListener;
use Modules\Skolkovo22\Booking\Entity\Estate;
use Modules\Skolkovo22\Booking\Entity\EstateCollection;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

final class Module extends AbstractModule
{
    /**
     * @return ServerMessageInterface
     */
    public function run(): ServerMessageInterface
    {
        $estateCollection = new EstateCollection();
        $estateCollection->put(new Estate('Cottage', 'Some cottage'));
        $estateCollection->put(new Estate('House', 'Some house'));
        
        MethodListener::call(self::class, 'run', $estateCollection);
        
        return $this->render(
            'index.php',
            [
                'estates' => $estateCollection->getCollection(),
            ],
            ServerMessageInterface::STATUS_OK,
            [
                'Booking-Service' => 'Welcome',
            ]
        );
    }
}
