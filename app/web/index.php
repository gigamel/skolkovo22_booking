<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\BookingApp;

(new BookingApp(\dirname(__DIR__)))->run();
