<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Notifications\UserApprovedNotification;
use Exception;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Password;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('sendUserApproved')
                ->tooltip('Open waiting room')
                ->icon('heroicon-m-arrow-top-right-on-square')
                ->action(function ($record): ?string {
                    $record->is_approved = true;
                    $record->save();
                    $status = Password::broker(Filament::getAuthPasswordBroker())->sendResetLink(
                        ['email' => $record->email],
                        function ($user, $token) {
                            if (! method_exists($user, 'notify')) {
                                throw new Exception('Model [' . get_class($user) . '] does not have a [notify()] method.');
                            }
                            $notification = new UserApprovedNotification($token);
                            $notification->url = Filament::getResetPasswordUrl($token, $user);

                            $user->notify($notification);
                        }
                    );
                    Notification::make()
                        ->title(__($status))
                        ->success()
                        ->send();

                    return null;
                }),
        ];
    }
}
