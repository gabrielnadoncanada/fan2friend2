<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

/**
 * Livewire Component for handling user login.
 */
class Login extends Component
{
    public $email;

    public $password;

    public $show;

    public $remember = false;

    public function mount()
    {
        if (request()->email) {
            $this->email = request()->email;
        }
    }

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        $throttleKey = strtolower($this->email) . '|' . request()->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $this->addError('email', __('auth.throttle', [
                'seconds' => RateLimiter::availableIn($throttleKey),
            ]));

            return null;
        }

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($throttleKey);

            $this->addError('email', __('auth.failed'));

            return null;
        }

        return redirect()->intended(route('home'));

    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
