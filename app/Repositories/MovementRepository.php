<?php

namespace App\Repositories;

use App\Models\Movement;
use App\Repositories\Abstract\BaseEloquentRepository;
use App\Repositories\Interfaces\MovementRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class MovementRepository extends BaseEloquentRepository implements MovementRepositoryInterface
{
  protected $model = Movement::class;
  private $movementEloquent;

  public function __construct(Movement $movement)
  {
    $this->movementEloquent = $movement;
  }

  public function getByEmployee($employeeId): Collection
  {
    return $this->getBy(['employee_id' => $employeeId], 25, ['employee']);
  }

  public function createMovement(array $data): Movement
  {
    return $this->movementEloquent
      ->create($data);
  }

  public function updateMovement(int $id, array $data): Movement
  {
    $movement = $this->movementEloquent
      ->findOrFail($id)
      ->fill($data);

    $movement->save();

    return $movement;
  }

}
