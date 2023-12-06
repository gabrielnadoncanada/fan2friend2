<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BasePage;
use Filament\Support\Facades\FilamentView;

class Login extends BasePage
{
    public function mount(): void
    {
        parent::mount();


    }

    public function fillUserByRole($role): void
    {
        $values = [];

        switch ($role) {
            case 'admin':
                $values = [
                    'email' => 'admin@fan2friend.app',
                    'password' => 'password',
                    'remember' => true,
                ];
                break;
            case 'celebrity':
                $values = [
                    'email' => 'celebrity@fan2friend.app',
                    'password' => 'password',
                    'remember' => true,
                ];
                break;
            case 'customer':
                $values = [
                    'email' => 'customer@fan2friend.app',
                    'password' => 'password',
                    'remember' => true,
                ];
        }

        $this->form->fill($values);
    }

}
