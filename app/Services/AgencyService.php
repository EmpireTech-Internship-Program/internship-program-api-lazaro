<?php

namespace App\Services;

use App\Models\Agency;
use App\Repositories\AgencyRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AgencyService
{
    private AgencyRepository $repository;

    public function __construct() {
        $this->repository = app()->make(AgencyRepository::class);
    }

    public function getAgencies(): Collection
    {
        return $this->repository->getAgencies();
    }

    public function getAgencyByName(string $name): ?Model
    {
        return $this->repository->getAgencyByName($name);
    }

    public function find(string $id): ?Agency
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