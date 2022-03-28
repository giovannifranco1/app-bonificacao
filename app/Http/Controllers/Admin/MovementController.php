<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\InsufficientBalanceException;
use App\Http\Controllers\Controller;
use App\Http\Requests\MovementRequest;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\Interfaces\MovementRepositoryInterface;
use App\Services\MovementService;
use DateTime;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class MovementController extends Controller
{
  protected $movementService;
  protected $movementRepo;
  protected $employeeRepo;

  public function __construct(
    EmployeeRepositoryInterface $employeeRepo,
    MovementRepositoryInterface $movementRepo,
    MovementService $movementService
  ) {
    $this->movementRepo = $movementRepo;
    $this->employeeRepo = $employeeRepo;
    $this->movementService = $movementService;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index()
  {
    # List
    $movements = $this->movementRepo->listAll(25);
    return view('admin.movement.index', compact('movements'));
  }

  public function create($employeeId): View
  {
    return view('admin.movement.create', compact('employeeId'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\MovementRequest  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function store(MovementRequest $request, int $employeeId)
  {
    # Data
    $data = collect($request->validated());

    # Removing comma and formating
    $data->put('value', doubleval(strtr((string) $data->get('value'), ['.' => '', ',' => '.'])));

    # Add employee_id in data
    $data->prepend($employeeId, 'employee_id');

    # Add administrator_id in data
    $data->prepend(auth()->guard('administrator')->user()->id, 'administrator_id');

    try {
      DB::transaction(function () use ($data, $request) {
        # Movement creation
        $movement = $this->movementService->create($data);

        # Check if it is income or expense
        $this->movementService->incomeOrExpense($data->get('movement_type'), $movement);
      });
    } catch (ModelNotFoundException $e) {
      throw $e;
    } catch (InsufficientBalanceException $e) {
      return redirect()
        ->back()
        ->withInput($request->except(['value']))
        ->withErrors(['value' => 'Insufficient Balance']);
    } catch (Exception $e) {
      report($e);
      return redirect()
        ->back()
        ->withErrors(['Error, I apologize we are working to resolve it as soon as possible.']);
    }

    return redirect()->route('movement.employee', compact('employeeId'))->with('success', 'Successful');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  public function showByEmployee(int $employeeId)
  {
    try {
      $employee = $this->employeeRepo->findById($employeeId);
      $movements = $this->movementRepo->getByEmployee($employeeId);
    } catch (Exception $e) {
      report($e);
      return redirect()
        ->back()
        ->withErrors(['Error, I apologize we are working to resolve it as soon as possible.']);
    }

    return view('admin.movement.employers', compact('movements', 'employee'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @return \Illuminate\Http\Response
   */

  public function search()
  {
    # Filtering data
    $filled = collect(request()->only([
      'full_name',
      'movement_type',
      'created_at',
    ]))->filter();

    if ($filled->get('created_at')) {
      $filled->put('created_at', new DateTime((string) $filled->get('created_at')));
    }

    try {
      # List
      $movements = $this->movementRepo->listAll(25, $filled->toArray());
    } catch (Exception $e) {
      report($e);
      return redirect()
        ->back()
        ->withErrors(['Error, I apologize we are working to resolve it as soon as possible.']);
    }
    $inputs = request()->all();
    return view('admin.movement.index', compact('movements', 'inputs'));
  }
}
