<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Events\RequestResetPasswordLink as RequestResetPasswordLinkEvent;
use App\Models\User;

class ForgotPasswordController extends Controller
{
  /**
   * Display the forgot password view.
   * @return View
   */
  public function index(): View
  {
    // return forgot password view
    return view('auth.forgot_password');
  }

  /**
   * Handle an incoming forgot password request.
   * @param ForgotPasswordRequest $request
   * @return RedirectResponse
   */
  public function store(ForgotPasswordRequest $request): RedirectResponse
  {
    // get user by email
    $user = User::where('email', $request->email)->first();
    // generate new password reset token
    $user->generatePasswordResetToken();
    // dispatch request verify email link event
    RequestResetPasswordLinkEvent::dispatch($user);
    // redirect to sign in page
    return back()->with('success', 'We have sent you an email to reset your password, please check your inbox (and spam folder).');
  }
}
