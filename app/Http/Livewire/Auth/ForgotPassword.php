<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email;

    public $status;

    protected $rules = [
        'email' => 'required|email',

    ];

    public function sendResetLink()
    {
        $this->validate();

        $status = Password::sendResetLink($this->only(['email']));

        if ($status == Password::RESET_LINK_SENT) {
            $this->status = __($status);
        } else {
            $this->addError('email', __($status));
        }
    }
}
