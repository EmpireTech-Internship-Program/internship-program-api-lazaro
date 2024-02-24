<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AbstractObserver
{
    public function creating(Model $model)
    {
        $model->user_id = Auth::id();
    }

    public function updating(Model $model)
    {
        $model->user_id = Auth::id();
    }

    public function deleting(Model $model)
    {
        $model->user_id = Auth::id();
    }
}
