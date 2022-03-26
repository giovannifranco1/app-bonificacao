<?php

namespace App\Services;

use App\Models\Employee;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;

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
  public function createEmployee(array $employee)
  {
    $this->employeeRepository->createEmployee(new Employee($employee));
  }
}
