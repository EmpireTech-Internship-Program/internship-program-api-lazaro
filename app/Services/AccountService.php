<?php

namespace App\Services;

use App\Models\Account;
use App\Repositories\AccountRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AccountService
{

    private AccountRepository $repository;

    public function __construct() {
        $this->repository = app()->make(AccountRepository::class);
    }

    public function getAccounts(): Collection
    {
        return $this->repository->getAccounts();
    }

    public function getAccountByName(string $name): ?Model
    {
        return $this->repository->getAccountByName($name);
    }

    public function find(string $id): ?Account
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