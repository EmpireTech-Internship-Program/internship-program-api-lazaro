<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'fullname',
        'date_of_birth',
        'cpf',
        'address',
        'phone_number',
        'email'
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
