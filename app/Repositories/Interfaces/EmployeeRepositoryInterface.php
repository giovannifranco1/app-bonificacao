<?php

namespace App\Repositories\Interfaces;

use App\Models\Employee;
use Illuminate\Contracts\Pagination\Paginator;

interface EmployeeRepositoryInterface
{
  public function __construct(Employee $funcionario);
  public function createEmployee(Employee $funcionario): Employee;
  public function updateEmployee(Employee $funcionario, int $id);
  public function listAll(): Paginator;
  public function deleteEmployee(int $id);
}
