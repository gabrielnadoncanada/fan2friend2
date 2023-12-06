<?php

namespace App\Http\Livewire\Auth;

use App\Events\UserCreated;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Filament\Facades\Filament;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $firstName = '';

    public $lastName = '';

    public $email = '';

    public $password = '';

    public $password_confirmation = '';

    protected $rules = [
        'firstName' => ['required', 'string', 'max:255'],
        'lastName' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'confirmed', 'min:8'],
    ];

    public function register()
    {
        $this->validate();

        $user = User::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ])->assignRole('customer');

        event(new UserCreated($user));
        event(new Registered($user));

        Filament::auth()->login($user);

        return redirect(RouteServiceProvider::HOME)->with('status', 'Compte créé avec succès.');
    }
}
