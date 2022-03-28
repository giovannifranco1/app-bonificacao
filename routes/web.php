<?php

use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MovementController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware gr"oup. Now create something great!
|
 */

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('auth.logout');
Route::post('login', [LoginController::class, 'login'])->name('auth.logar');

Route::group(['middleware' => 'auth:administrator'], function () {
  Route::get('/', [HomeController::class, 'index'])->name('admin.index');

  # Employers routes
  Route::get('employers', [EmployeeController::class, 'index'])->name('employee.index');
  Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
  Route::get('employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
  Route::get('employee/search', [EmployeeController::class, 'search'])->name('employee.search');
  Route::get('employee/{id}/movements', [EmployeeController::class, 'getMovements'])->name('employee.movements');
  Route::post('employee/store', [EmployeeController::class, 'store'])->name('employee.store');
  Route::put('employee/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
  Route::delete('employee/delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

  # Movement routes
  Route::get('movements', [MovementController::class, 'index'])->name('movement.index');
  Route::get('movement/create/{employeeId}', [MovementController::class, 'create'])->name('movement.create');
  Route::post('movement/store/{employeeId}', [MovementController::class, 'store'])->name('movement.store');
  Route::get('movement/edit', [MovementController::class, 'edit'])->name('movement.edit');
  Route::get('movements/employee/{employeeId}', [MovementController::class, 'showByEmployee'])->name('movement.employee');
  Route::get('movements/search', [MovementController::class, 'search'])->name('movement.search');
});
