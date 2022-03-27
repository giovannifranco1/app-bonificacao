<?php

use App\Http\Controllers\Admin\EmployeeController;
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
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
  return view('admin.home');
})->name('home');
Route::get('login', [LoginController::class, 'index'])->name('auth.index');
Route::post('login', [LoginController::class, 'login'])->name('auth.logar');

# Employers routes
Route::get('employers', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::get('employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::get('employee/search', [EmployeeController::class, 'search'])->name('employee.search');
Route::get('employee/{id}/movements', [EmployeeController::class, 'getMovements'])->name('employee.movements');
Route::post('employee', [EmployeeController::class, 'store'])->name('employee.store');
Route::put('employee/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('employee/delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

# Movement routes
Route::get('movements', [MovementController::class, 'index'])->name('movement.index');
Route::get('movement/create', [MovementController::class, 'index'])->name('movement.create');
Route::get('movements/employee/{employeeId}', [MovementController::class, 'showByEmployee'])->name('movement.employee');
