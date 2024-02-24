<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    private UserRepository $repository;

    public function __construct() {
        $this->repository = app()->make(UserRepository::class);
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function find(string $id): ?User
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
}