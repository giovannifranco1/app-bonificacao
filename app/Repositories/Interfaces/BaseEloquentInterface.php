<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseEloquentInterface
{
  public function all($orderBy = 'id', array $relations = []): Collection;
  public function findBy($field, $value, array $relations = []): ?Model;
  public function paginate(int $paginate = 25, $orderBy = 'full_name', $parameters = [], array $relations = []);
  public function getBy($parameters, int $bring = 0, array $relations = []);
}
