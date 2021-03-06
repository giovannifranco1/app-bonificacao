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
      # Add administrator_id
      $data->prepend(auth()->guard('administrator')->user()->id, 'administrator_id');
      $data->put('password', bcrypt($data->get('password')));

      # Employee creation
      $employee = $this->employeeRepository->createEmployee($data->toArray());
      return $employee;
    }

    # Hash
    $data->get('password')
    ? bcrypt($data->get('password'))
    : $data->put('password', $existingEmployee->password);

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
