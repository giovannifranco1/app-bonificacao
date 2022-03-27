<?php

namespace App\Services;

use App\Models\Employee;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class EmployeeService
{
  /** @var EmployeeRepositoryInterface */
  protected $employeeRepository;

  public function __construct(EmployeeRepositoryInterface $employeeRepository)
  {
    $this->employeeRepository = $employeeRepository;
  }

  /**
   * @throws Exceptions
   */
  public function storeOrUpdate(Collection $data, int $employeeId = 0): Employee
  {
    # Find employee by id
    $existingEmployee = $this->employeeRepository->findBy('id', $employeeId);

    if (!$existingEmployee) {
      $data->prepend(auth()->guard('administrator')->user()->id, 'administrator_id');
      $employee = $this->employeeRepository->createEmployee($data->toArray());
      return $employee;
    }

    return $this->employeeRepository->updateEmployee($employeeId, $data->toArray());
  }

  public function findById(int $employeeId): Employee
  {
    $employee = $this->employeeRepository->findBy('id', $employeeId);

    if (!$employee) {
      throw new ModelNotFoundException();
    }

    return $employee;
  }
}
