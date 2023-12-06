<?php

namespace App\Listeners;

use App\Events\OrderPaidEvent;
use App\Notifications\OrderPaidNotification;

class SendOrderPaidNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPaidEvent $event)
    {
        $event->order->user->notify(new OrderPaidNotification($event->order));
    }
}
