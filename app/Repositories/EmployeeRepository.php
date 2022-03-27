<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\Abstract\BaseEloquentRepository;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator as Pagination;

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

  public function updateEmployee(int $id, array $data): Employee
  {
    $employee = $this->employeeEloquent
      ->findOrFail($id)
      ->fill($data);

    $employee->save();

    return $employee;
  }

  public function listAll(int $paginate, array $parameters = []): Pagination
  {
    $callbak_parameters = function ($query) use ($parameters) {
      $query->when(array_key_exists('created_at', $parameters), fn($q) =>
        $q->whereDate('created_at', $parameters['created_at'])
      )->when(array_key_exists('full_name', $parameters), fn($q) =>
        $q->where('full_name', 'like', "%{$parameters['full_name']}%")
      );
    };

    return $this->employeeEloquent
      ->with('administrator')
      ->where($callbak_parameters)
      ->orderBy('full_name', 'asc')
      ->paginate($paginate);

  }

  public function findById(int $id): Employee
  {
    return $this->employeeEloquent
      ->with('administrator')
      ->findOrFail($id);
  }

  public function deleteEmployee(int $id)
  {
    return $this->employeeEloquent
      ->find($id)
      ->deleteOrfail($id);
  }
}
