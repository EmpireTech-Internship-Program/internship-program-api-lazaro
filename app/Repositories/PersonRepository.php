<?php

namespace App\Repositories;

use App\Models\Person;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;

class PersonRepository extends AbstractRepository
{
    public function __construct(Person $person) {
        parent::__construct($person);
    }

    public function getPeople(): Collection
    {
        return $this->model::with('user')->get();
    }

    public function getPeopleByName(string $name): ?Person
    {
        return $this->model::where('name', $name)->first();
    }
}