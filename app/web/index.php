<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\BookingApp;

ini_set('display_errors', '1');
error_reporting(E_ALL);

(new BookingApp(\dirname(__DIR__)))->run();
