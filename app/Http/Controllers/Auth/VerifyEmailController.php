<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyEmailRequest;
use Illuminate\Contracts\View\View;
use App\Models\Token;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Events\RequestVerifyEmailLink as RequestVerifyEmailLinkEvent;
use App\Models\User;

class VerifyEmailController extends Controller
{
  /**
   * Display the verify email view.
   * @return View
   */
  public function index(Request $request): RedirectResponse | View
  {
    // if session error === 'Token expired.'
    if ($request->session()->has('error')) {
      // return verify email view with error
      return view('auth.verify_email')->with('error', $request->session()->get('error'));
    }

    // get email verification token
    $token = Token::where(['type' => 'email_verification_token', 'token' => $request->query('email_verification_token')])->firstOrFail();

    // get user
    $user = $token->user;

    // update user
    $user->update([
      'email_verified_at' => now(),
    ]);

    // revoke email verification token
    $token->update([
      'revoked_at' => now(),
    ]);

    // log user in
    auth()->login($user);

    // redirect to home page
    return redirect()->route('home')->with('success', 'Your email address has been verified successfully.');
  }

  /**
   * Handle an incoming verify email request.
   * @param VerifyEmailRequest $request
   * @return View
   */
  public function store(VerifyEmailRequest $request): RedirectResponse
  {
    // get user by email
    $user = User::where('email', $request->email)->first();
    // generate new email verification token
    $user->generateEmailVerificationToken();
    // dispatch request verify email link event
    RequestVerifyEmailLinkEvent::dispatch($user);
    // redirect to verify email page
    return to_route('auth.verify_email.index')->with('success', 'We have sent you an email to verify your email address, please check your inbox (and spam folder).');
  }
}
