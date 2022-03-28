<?php

namespace App\Services;

use App\Models\Movement;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\Interfaces\MovementRepositoryInterface;
use Illuminate\Support\Collection;

class MovementService
{
  /** @var  MovementRepositoryInterface */
  protected $movementRepo;

  /** @var  EmployeeRepositoryInterface */
  protected $employeeRepo;

  public function __construct(
    MovementRepositoryInterface $movementRepo,
    EmployeeRepositoryInterface $employeeRepo
  ) {
    $this->movementRepo = $movementRepo;
    $this->employeeRepo = $employeeRepo;
  }

  public function incomeOrExpense($movementType, Movement $movement): void
  {
    $employee = $this->employeeRepo->findById($movement->employee_id);
    match($movementType) {
      'income' => $this->employeeRepo->income($employee, $movement->value),
      'expense' => $this->employeeRepo->expense($employee, $movement->value)
    };
  }

  public function create(Collection $data): Movement
  {
    $movement = $this->movementRepo->createMovement($data->toArray());
    return $movement;
  }
}
