<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface PersonRepositoryInterface extends RepositoryInterface
{
    public function getPeople(): Collection;
    public function getPersonByName(string $name): ?Model;
}