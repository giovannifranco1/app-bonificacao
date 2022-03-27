<?php

namespace App\Repositories\Interfaces;

use App\Models\Employee;
use Illuminate\Pagination\LengthAwarePaginator;

interface EmployeeRepositoryInterface extends BaseEloquentInterface
{
  public function __construct(Employee $funcionario);
  public function createEmployee(array $data): Employee;
  public function updateEmployee(int $id, array $data): Employee;
  public function listAll(int $paginate, array $parameters = []): LengthAwarePaginator;
  public function findById(int $id): Employee;
  public function deleteEmployee(int $id);
}
