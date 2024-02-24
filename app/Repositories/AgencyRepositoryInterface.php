<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface AgencyRepositoryInterface extends RepositoryInterface
{
    public function getAgencies(): Collection;
    public function getAgencyByName(string $name): ?Model;
}