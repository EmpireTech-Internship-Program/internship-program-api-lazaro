<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}