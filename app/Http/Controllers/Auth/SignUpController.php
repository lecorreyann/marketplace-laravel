<?php

namespace App\Http\Controllers\Auth;

use App\Events\AccountCreated as AccountCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use Illuminate\Contracts\View\View;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class SignUpController extends Controller
{
  /**
   * Display the sign up view.
   * @return View
   */
  public function index(): View
  {
    // return sign up view
    return view('auth.sign_up');
  }

  /**
   * Handle an incoming sign up request.
   * @param SignUpRequest $request
   * @return RedirectResponse
   */
  public function store(SignUpRequest $request): RedirectResponse
  {
    // create user
    $user = User::create([
      'first_name' => $request->first_name,
      'last_name' => $request->last_name,
      'email' => $request->email,
      'password' => $request->password,
    ]);
    // send account created notification
    AccountCreatedEvent::dispatch($user);
    // redirect to sign in page
    return back()->with('success', 'Your account has been created successfully. We have sent you an email to verify your email address and activate your account, please check your inbox (and spam folder).');
  }
}
