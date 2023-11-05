<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Blade Views
    |--------------------------------------------------------------------------
    |
    | - This option allows you to customize the views used by Livewire Calendar.
    | - You can publish the views using the `php artisan vendor:publish` command.
    | - The views are published to `resources/views/vendor/livewire-calendar`.
    | - You can also change the views path below to a custom path.
    |
    */

    'views' => [
        'calendar' => 'calendar.calendar',
        'day' => 'calendar.day',
        'week' => 'calendar.week',
        'month' => 'calendar.month',
        'year' => 'calendar.year',
        'event' => 'calendar.event',
    ],
    'formats' => [
        'full' => 'F d, Y',
        'month_year' => 'F Y',
        'month' => 'F',
        'day' => 'l',
    ],
];
