<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\Abstract\BaseEloquentRepository;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;

class EmployeeRepository extends BaseEloquentRepository implements EmployeeRepositoryInterface
{
  protected $model = Employee::class;
  private $EmployeeEloquent;

  public function __construct(Employee $Employee)
  {
    $this->EmployeeEloquent = $Employee;

  }

  public function createEmployee(Employee $Employee): Employee
  {
    return $this->EmployeeEloquent
      ->create($Employee);
  }

  public function updateEmployee(Employee $Employee, int $id)
  {
    return $this->EmployeeEloquent
      ->find($id)
      ->fill($Employee)
      ->save();
  }

  public function listAll(): Paginator
  {
    return $this->paginate('full_name', array('adiminstrator'));
  }
  public function deleteEmployee(int $id)
  {
    return $this->EmployeeEloquent
      ->find($id)
      ->delete();
  }
}
