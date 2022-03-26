<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseEloquentInterface
{
  public function all($orderBy = 'id', array $relations = []): Collection;
  public function findBy($field, $value, array $relations = []): Model;
  public function paginate(int $paginate = 25, $orderBy = 'full_name', array $relations = [], $parameters = []);
}
