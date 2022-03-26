<?php

namespace App\Repositories\Interfaces;

use App\Models\Employee;
use Illuminate\Contracts\Pagination\Paginator;

interface EmployeeRepositoryInterface extends BaseEloquentInterface
{
  public function __construct(Employee $funcionario);
  public function createEmployee(array $data): Employee;
  public function updateEmployee(int $id, array $data);
  public function listAll(): Paginator;
  public function deleteEmployee(int $id);
  public function findBy($field, $value, array $relations = []);
}
