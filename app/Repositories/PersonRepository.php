<?php

namespace App\Repositories;

use App\Models\Person;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PersonRepository extends AbstractRepository
{
    public function __construct(Person $person) {
        parent::__construct($person);
    }

    public function getPeople(): Collection
    {
        return $this->model::with('user')->get();
    }

    public function getPeopleByName(string $name): ?Model
    {
        return $this->model::where('name', $name)->first();
    }
}