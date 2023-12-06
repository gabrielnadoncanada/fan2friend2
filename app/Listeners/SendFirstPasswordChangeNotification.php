<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Notifications\FirstPasswordChangeNotification;
use Illuminate\Support\Facades\Password;

class SendFirstPasswordChangeNotification
{
    public function handle(UserCreated $event): void
    {

        $token = Password::createToken($event->user);

        $url = url(route('password.reset', [
            'token' => $token,
            'email' => $event->user->getEmailForPasswordReset(),
        ], false));

        $event->user->notify(new FirstPasswordChangeNotification($url));
    }
}
