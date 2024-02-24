<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    public function updating(User $user)
    {
        $user->user_id = Auth::id();
    }
}
