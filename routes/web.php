<?php

use App\Http\Controllers\Admin\EmployeeController;
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
});

Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('employee/store', [EmployeeController::class, 'store'])->name('employee.store');
