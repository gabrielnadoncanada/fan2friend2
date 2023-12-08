<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\NewUserPasswordResetNotification;
use Exception;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UserObserver
{
    public function creating(User $user): void
    {
        $user->forceFill([
            'password' => Hash::make($user->password),
        ]);
    }

    public function created(User $user): void
    {
        if ($user->hasRole('celebrity') && ! $user->is_approved) {
            return;
        }

        $status = Password::broker(Filament::getAuthPasswordBroker())->sendResetLink(
            ['email' => $user->email],
            function ($user, $token) {
                if (! method_exists($user, 'notify')) {
                    throw new Exception('Model [' . get_class($user) . '] does not have a [notify()] method.');
                }

                $notification = new NewUserPasswordResetNotification($token);
                $notification->url = Filament::getResetPasswordUrl($token, $user);

                $user->notify($notification);
            }
        );

        if ($status !== Password::RESET_LINK_SENT) {
            Notification::make()
                ->title(__($status))
                ->danger()
                ->send();

            return;
        }

        Notification::make()
            ->title(__($status))
            ->success()
            ->send();
    }
}
