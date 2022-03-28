<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
  protected $redirectTo = '/';

  public function index(): View
  {
    return view('auth.index');
  }

  public function login(AuthRequest $request): RedirectResponse
  {
    if (auth()->guard('administrator')->attempt($request->validated())) {
      return redirect()->route('admin.index');
    };
    return redirect()->back()->withErrors(['Login And Password Are Wrong.']);
  }

  public function logout()
  {
    auth()->guard('administrator')->logout();
    return redirect()->route('admin.index');
  }

}
