<?php

namespace App\Repositories;

use App\Models\Movement;
use App\Repositories\Abstract\BaseEloquentRepository;
use App\Repositories\Interfaces\MovementRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Database\Eloquent\Collection;

class MovementRepository extends BaseEloquentRepository implements MovementRepositoryInterface
{
  /** @var Movement */
  protected $model = Movement::class;
  private $movementEloquent;

  public function __construct(Movement $movement)
  {
    $this->movementEloquent = $movement;
  }

  /**
   * @return Collection
   * @param int $employeeId
   */

  public function getByEmployee($employeeId): Collection
  {
    return $this->getBy(['employee_id' => $employeeId], 200, ['employee']);
  }

  /**
   * @return Movement
   * @param array $data
   */

  public function createMovement(array $data): Movement
  {
    return $this->movementEloquent
      ->create($data);
  }

  /**
   * @return Paginator
   * @param int $paginate
   * @param array $parameters
   */

  public function listAll(int $paginate, array $parameters = []): Paginator
  {
    $callbak_parameters = function ($query) use ($parameters) {
      $query->when(array_key_exists('created_at', $parameters), fn($q) =>
        $q->whereDate('created_at', $parameters['created_at'])
      )->when(array_key_exists('full_name', $parameters), fn($q) =>
        $q->whereHas('employee', function ($q) use ($parameters) {
          $q->where('full_name', 'like', "%{$parameters['full_name']}%");
        })
      )->when(array_key_exists('movement_type', $parameters), fn($q) =>
        $q->where('movement_type', $parameters['movement_type'])
      );
    };

    return $this->movementEloquent
      ->with('employee')
      ->where($callbak_parameters)
      ->orderBy('id', 'desc')
      ->paginate($paginate);
  }

  /**
   * @return Movement
   * @param int $id
   * @param array $data
   */

  public function updateMovement(int $id, array $data): Movement
  {
    $movement = $this->movementEloquent
      ->findOrFail($id)
      ->fill($data);

    $movement->save();

    return $movement;
  }

}
