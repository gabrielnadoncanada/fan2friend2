<?php

namespace App\Events;

use App\Models\User;

class UserApproved
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
