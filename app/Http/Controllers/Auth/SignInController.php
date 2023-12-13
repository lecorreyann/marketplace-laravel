<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class SignInController extends Controller
{
  /**
   * Display the sign in view.
   * @return View
   */
  public function index(): View
  {
    // return sign in view
    return view('auth.sign_in');
  }

  /**
   * Handle an incoming sign in request.
   * @param SignInRequest $request
   * @return RedirectResponse
   */
  public function store(SignInRequest $request): void
  {
  }
}
