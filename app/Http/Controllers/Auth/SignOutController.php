<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class SignOutController extends Controller
{
  /**
   * Handle an incoming sign out request.
   * @param SignInRequest $request
   * @return RedirectResponse
   */
  public function delete(): RedirectResponse
  {
    if (auth()->check()) {
      auth()->logout();
    }

    return to_route('auth.sign_in.index');
  }
}
