<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\User;
use App\Notifications\FirstPasswordChangeNotification;
use App\Notifications\TeacherApprovalNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Password;

class SendUserCreationNotification
{
    public function handle(UserCreated $event): void
    {
        $token = Password::createToken($event->user);

        switch ($event->user->role) {
            case 'teacher':
                //Compte déjà approuvé, provient de la création de compte des admins
                if ($event->user->ccdmd_approved) {
                    $url = url(route('password.reset', [
                        'token' => $token,
                        'email' => $event->user->getEmailForPasswordReset(),
                    ], false));
                    $event->user->notify(new FirstPasswordChangeNotification($url));
                }

                //Compte non approuvé, provient de la création de compte de l'acceuil
                else {
                    $url = url(route('admin.users.edit', [
                        'userId' => $event->user->id,
                    ], false));

                    $admins = User::whereHas('roles', function (Builder $query) {
                        $query->where('name', '=', 'admin');
                    })->get();

                    foreach ($admins as $admin) {
                        $admin->notify(new TeacherApprovalNotification($url));
                    }
                }

                break;
            case 'admin':
            case 'student':
                $url = url(route('password.reset', [
                    'token' => $token,
                    'email' => $event->user->getEmailForPasswordReset(),
                ], false));
                $event->user->notify(new FirstPasswordChangeNotification($url));

                break;
            default:
        }

    }
}
