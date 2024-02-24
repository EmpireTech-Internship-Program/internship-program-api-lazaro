<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agencies()
    {
        return $this->hasMany(Agency::class);
    }
}