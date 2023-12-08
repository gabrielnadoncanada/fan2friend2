<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\User;
use App\Notifications\TeacherApprovalNotification;
use Illuminate\Database\Eloquent\Builder;

class SendUserCreationNotification
{
    public function handle(UserCreated $event): void
    {

        if ($event->user->hasRole('Celebrity')) {
            $url = url('dashboard/users/' . $event->user->id . '/edit', false);

            $admins = User::whereHas('roles', function (Builder $query) {
                $query->where('name', '=', 'Admin');
            })->get();

            foreach ($admins as $admin) {
                $admin->notify(new TeacherApprovalNotification($url));
            }
        }
    }
}
