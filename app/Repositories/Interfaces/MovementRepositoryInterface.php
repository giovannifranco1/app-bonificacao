<?php

namespace App\Repositories\Interfaces;

use App\Models\Movement;
use Illuminate\Database\Eloquent\Collection;

interface MovementRepositoryInterface extends BaseEloquentInterface
{
  public function getByEmployee($employeeId): Collection;
  public function createMovement(array $data): Movement;
  public function updateMovement(int $id, array $data): Movement;
}
