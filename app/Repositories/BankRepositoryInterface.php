<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BankRepositoryInterface extends RepositoryInterface
{
    public function getBanks(): Collection;
    public function getBankByName(string $name): ?Model;
}