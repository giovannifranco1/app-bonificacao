<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface MovementRepositoryInterface extends BaseEloquentInterface
{
  public function getByEmployee($employeeId): Collection;
}
