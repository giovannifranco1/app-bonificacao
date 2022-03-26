<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  protected $redirectTo = '/';

  public function index(): View
  {
    return view('auth.index');
  }

  public function login(AuthRequest $request): RedirectResponse
  {
    $credentials = $request->only('email', 'password');
    dd(Auth::attempt($credentials));

    return redirect()->route('home');
  }
}
