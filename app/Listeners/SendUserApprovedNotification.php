<?php

namespace App\Listeners;

use App\Events\UserApproved;
use App\Notifications\UserApprovedNotification;

class SendUserApprovedNotification
{
    public function handle(UserApproved $event): void
    {
        $url = url(route('login', [
            'email' => $event->user->getEmailForPasswordReset(),
        ], false));

        $event->user->notify(new UserApprovedNotification($url));
    }
}
