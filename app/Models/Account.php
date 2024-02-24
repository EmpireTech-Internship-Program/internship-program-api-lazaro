<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'person_cpf',
        'agency_name',
        'type',
        'number',
        'holder',
        'opening_balance',
        'opening_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_name', 'name');
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_cpf', 'cpf');
    }
}