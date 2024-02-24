<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_name',
        'name',
        'number',
        'address',
        'code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_name', 'name');
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
