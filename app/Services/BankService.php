<?php

namespace App\Services;

use App\Models\Bank;
use App\Repositories\BankRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BankService
{

    private BankRepository $repository;

    public function __construct() {
        $this->repository = app()->make(BankRepository::class);
    }

    public function getBanks(): Collection
    {
        return $this->repository->getBanks();
    }

    public function getBankByName(string $name): ?Model
    {
        return $this->repository->getBankByName($name);
    }

    public function find(string $id): ?Bank
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