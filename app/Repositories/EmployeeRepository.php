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

  public function createEmployee(array $data): Employee
  {
    return $this->employeeEloquent
      ->create($data);
  }

  public function updateEmployee(int $id, array $data)
  {
    return $this->employeeEloquent
      ->find($id)
      ->fill($data)
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
