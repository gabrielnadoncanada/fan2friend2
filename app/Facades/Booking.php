<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Booking extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bookingService';
    }
}
