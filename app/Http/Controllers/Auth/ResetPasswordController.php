<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Contracts\View\View;
use App\Models\Token;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Events\PasswordReset as PasswordResetEvent;

class ResetPasswordController extends Controller
{
  /**
   * Display the reset password view.
   * @return View
   */
  public function index(Request $request): View
  {
    return view('auth.reset_password');
  }

  /**
   * Handle an incoming reset password request.
   * @param ResetPasswordRequest $request
   * @return View
   */
  public function update(ResetPasswordRequest $request): RedirectResponse
  {
    // token
    $token = Token::where(['type' => 'password_reset_token', 'token' => $request->query('password_reset_token')])->firstOrFail();
    // get user by email
    $user = $token->user;
    // update user
    $user->update([
      'password' => $request->password,
    ]);
    // revoke password reset token
    $token->update([
      'revoked_at' => now(),
    ]);
    // dispatch request verify email link event
    PasswordResetEvent::dispatch($user);
    // // redirect to verify email page
    return to_route('auth.reset_password.index')->with('success', 'Your password has been reset.');
  }
}
