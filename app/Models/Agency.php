<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agency extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'number',
        'address',
        'code'
    ];

    public function banks()
    {
        return $this->belongsTo(Bank::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
