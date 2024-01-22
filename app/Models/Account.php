<?php

namespace App\Models;

use Faker\Provider\ar_SA\Person;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'type',
        'number',
        'holder',
        'opening_balance',
        'opening_date'
    ];

    public function agencies()
    {
        return $this->belongsTo(Agency::class);
    }

    public function people()
    {
        return $this->hasMany(Person::class);
    }
}