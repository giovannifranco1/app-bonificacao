<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Services\EmployeeService;
use DateTime;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
    $employees = $this->employeeRepo->paginate(25, 'full_name', [], $relations->toArray());

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
      report($e);
      return redirect()
        ->back()
        ->withInput($request->all())
        ->withErrors(['Error registering employee, I apologize we are working to resolve it as soon as possible.']);
    }
    return redirect()
      ->back()
      ->with('success', 'successfully created');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    try {
      $this->employeeRepo->findBy('id', $id);
    } catch (ModelNotFoundException $e) {
      throw $e;
    } catch (Exception $e) {
      report($e);
      return redirect()
        ->back()
        ->withErrors(['Error find employee, I apologize we are working to resolve it as soon as possible.']);
    }
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
      $employee = $this->employeeRepo->findById($id);
    } catch (ModelNotFoundException $e) {
      throw $e;
    } catch (Exception $e) {
      report($e);
      return redirect()
        ->back()
        ->withErrors(['Error find employee, I apologize we are working to resolve it as soon as possible.']);
    }
    return view('admin.employee.edit', compact('employee'));
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
    try {
      $this->employeeRepo->updateEmployee($id, $request->validated());
    } catch (ModelNotFoundException $e) {
      throw $e;
    } catch (Exception $e) {
      report($e);
      return redirect()
        ->back()
        ->withErrors(['Error find employee, I apologize we are working to resolve it as soon as possible.']);
    }
    return redirect()->back()->with('success', 'successfully deleted');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id): RedirectResponse
  {
    try {
      $this->employeeRepo->deleteEmployee($id);
    } catch (ModelNotFoundException $e) {
      throw $e;
    } catch (Exception $e) {
      report($e);
      return redirect()
        ->back()
        ->withErrors(['Error find employee, I apologize we are working to resolve it as soon as possible.']);
    }
    return redirect()->back()->with('success', 'successfully deleted');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @return \Illuminate\Http\Response
   */

  public function search()
  {
    $filled = collect(request()->only([
      'full_name',
      'created_at',
    ]))->filter();

    if ($filled->get('created_at')) {
      $filled->put('created_at', new DateTime((string) $filled->get('created_at')));
    }

    try {
      $employees = $this->employeeRepo->listAll(25, $filled->toArray());
    } catch (Exception $e) {
      report($e);
      return redirect()
        ->back()
        ->withErrors(['Error search employee, I apologize we are working to resolve it as soon as possible.']);
    }
    $inputs = request()->all();
    return view('admin.employee.index', compact('employees', 'inputs'));
  }
}
