<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\Abstract\BaseEloquentRepository;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class EmployeeRepository extends BaseEloquentRepository implements EmployeeRepositoryInterface
{
  protected $model = Employee::class;
  private $employeeEloquent;

  public function __construct(Employee $employee)
  {
    $this->employeeEloquent = $employee;

  }

  public function createEmployee(Employee $employee): Employee
  {
    return $this->employeeEloquent
      ->create($employee);
  }

  public function updateEmployee(Employee $employee, int $id)
  {
    return $this->employeeEloquent
      ->find($id)
      ->fill($employee)
      ->save();
  }

  public function listAll(): Paginator
  {
    return $this->paginate('full_name', ['adiminstrator']);
  }
  public function deleteEmployee(int $id)
  {
    return $this->employeeEloquent
      ->find($id)
      ->delete();
  }
}
