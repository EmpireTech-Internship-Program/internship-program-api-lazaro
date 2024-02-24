<?php

namespace App\Repositories;

use App\Models\Account;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AccountRepository extends AbstractRepository
{
    public function __construct(Account $account) 
    {
        parent::__construct($account);
    }

    public function getAccounts(): Collection
    {
        return $this->model::with('user', 'agency', 'person')->get();
    }

    public function getAccountByName(string $name): ?Model
    {
        return $this->model::where('name', $name)->first();
    }
}