<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\InsufficientBalanceException;
use App\Http\Controllers\Controller;
use App\Http\Requests\MovementRequest;
use App\Repositories\Interfaces\MovementRepositoryInterface;
use App\Services\MovementService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class MovementController extends Controller
{
  protected $movementService;
  protected $movementRepo;

  public function __construct(
    MovementRepositoryInterface $movementRepo,
    MovementService $movementService
  ) {
    $this->movementRepo = $movementRepo;
    $this->movementService = $movementService;
  }

  public function index()
  {
    return view('admin.movement.index');
  }

  public function create($employeeId): View
  {
    return view('admin.movement.create', compact('employeeId'));
  }

  public function store(MovementRequest $request, int $employeeId)
  {
    $data = collect($request->validated());
    $data->prepend($employeeId, 'employee_id');
    $data->prepend(auth()->guard('administrator')->user()->id, 'administrator_id');

    try {
      DB::transaction(function () use ($data) {
        $movement = $this->movementService->create($data);
        $this->movementService->incomeOrExpense($data->get('movement_type'), $movement);
      });
    } catch (ModelNotFoundException $e) {
      throw $e;
    } catch (InsufficientBalanceException $e) {
      return redirect()
        ->back()
        ->withErrors(['Insufficient Balance']);
    } catch (Exception $e) {
      report($e);
      return redirect()
        ->back()
        ->withErrors(['Error find employee, I apologize we are working to resolve it as soon as possible.']);
    }

    return redirect()->route('movement.employee', compact('employeeId'))->with('success', 'Successful');
  }

  public function showByEmployee($employeeId)
  {
    try {
      $movements = $this->movementRepo->getByEmployee($employeeId);
    } catch (Exception $e) {
      report($e);
      return redirect()
        ->back()
        ->withErrors(['Error search movements, I apologize we are working to resolve it as soon as possible.']);
    }
    return view('admin.movement.employers', compact('movements', 'employeeId'));
  }

  public function search()
  {
    # code...
  }
}
