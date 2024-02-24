<?php

namespace App\Services;

use App\Models\Person;
use App\Repositories\PersonRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PersonService
{

    private PersonRepository $repository;

    public function __construct() {
        $this->repository = app()->make(PersonRepository::class);
    }

    public function getPeople(): Collection
    {
        return $this->repository->getPeople();
    }

    public function getPersonByName(string $name): ?Model
    {
        return $this->repository->getPeopleByName($name);
    }

    public function find(string $id): ?Person
    {
        return $this->repository->find($id);
    }

    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    public function update(string $id, array $data): bool
    {
        return $this->repository->update($id, $data);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }
}