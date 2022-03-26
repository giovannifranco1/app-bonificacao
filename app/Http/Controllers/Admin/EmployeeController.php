<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Services\EmployeeService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;

class EmployeeController extends Controller
{
  protected $employeeService;
  protected $employeeRepo;

  public function __construct(
    EmployeeService $employeeService,
    EmployeeRepositoryInterface $employeeRepo
  ) {
    $this->employeeService = $employeeService;
    $this->employeeRepo = $employeeRepo;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index(): View
  {
    $relations = collect('administrator');
    $employees = $this->employeeRepo->paginate(10, 'full_name', $relations->toArray());

    return view('admin.employee.index', compact('employees'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(): View
  {
    return view('admin.employee.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(EmployeeRequest $request): RedirectResponse
  {
    try {
      $this->employeeService->storeOrUpdate(collect($request->validated()));
    } catch (Exception $e) {
      return redirect()->back()->withErrors($e->getMessage());
    }

    return redirect()->back();
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    try {
      $this->employeeRepo->findBy('id', $id);
    } catch (ModelNotFoundException $e) {
      return redirect()->back()->withErrors($e->getMessage());
    }
    return view();
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(EmployeeRequest $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
