<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getAll(): Collection;
    public function getByEmail(string $email): ?User;
}