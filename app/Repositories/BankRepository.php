<?php

namespace App\Repositories;

use App\Models\Bank;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BankRepository extends AbstractRepository
{
    public function __construct(Bank $bank) {
        parent::__construct($bank);
    }

    public function getBanks(): Collection
    {
        return $this->model::with('user')->get();
    }

    public function getBankByName(string $name): ?Model
    {
        return $this->model::where('name', $name)->first();
    }
}