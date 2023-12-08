<?php

namespace App\Providers;

use App\Events\OrderPaidEvent;
use App\Events\UserApproved;
use App\Events\UserCreated;
use App\Listeners\SendOrderPaidNotification;
use App\Listeners\SendUserApprovedNotification;
use App\Listeners\SendUserCreationNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderPaidEvent::class => [
            SendOrderPaidNotification::class,
        ],
        UserCreated::class => [
            SendUserCreationNotification::class,
        ],
        UserApproved::class => [
            SendUserApprovedNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
    }
}
