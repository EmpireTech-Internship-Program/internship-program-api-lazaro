<?php

namespace App\Repositories;

use App\Models\Agency;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AgencyRepository extends AbstractRepository
{
    public function __construct(Agency $agency) 
    {
        parent::__construct($agency);
    }

    public function getAgencies(): Collection
    {
        return $this->model::with('user', 'bank')->get();
    }

    public function getAgencyByName(string $name): ?Model
    {
        return $this->model::where('name', $name)->first();
    }
}