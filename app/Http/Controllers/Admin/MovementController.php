<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\MovementRepository;
use App\Services\MovementService;
use Exception;

class MovementController extends Controller
{
  protected $movementService;
  protected $movementRepo;

  public function __construct(
    MovementRepository $movementRepo,
    MovementService $movementService
  ) {
    $this->movementRepo = $movementRepo;
    $this->movementService = $movementService;
  }
  public function index()
  {
    # code...
  }

  public function create()
  {
    # code...
  }

  public function store()
  {
    # code...
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
    return;
  }

  public function search()
  {
    # code...
  }
}
