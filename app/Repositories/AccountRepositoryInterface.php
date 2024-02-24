<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface AccountRepositoryInterface extends RepositoryInterface
{
    public function getAccounts(): Collection;
    public function getAccountByName(string $name): ?Model;
}