<?php

namespace App\Http\Livewire\Auth;

use App\Events\UserCreated;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
    ];

    public function register()
    {
        $this->validate();

        $randomPassword = Str::random(10); // You can change '10' to any length you want

        $user = User::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'is_approved' => false,
            'password' => Hash::make($randomPassword),
        ]);

        $user->assignRole('celebrity');
        event(new UserCreated($user));
        //        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME)->with('status', 'Compte créé avec succès.');
    }
}
