<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Request;

class UserRepository extends AbstractRepository
{
    public function __construct(User $user) 
    {
        parent::__construct($user);
    }

    public function getAll(): Collection
    {
        return $this->model->get();
    }

    public function getByEmail(string $email): ?User
    {
        return $this->model::where('email', $email)->first();
    }
}