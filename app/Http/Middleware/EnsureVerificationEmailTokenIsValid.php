<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Token;

class EnsureVerificationEmailTokenIsValid
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    // if success in session
    if ($request->session()->has('success')) {
      return $next($request);
    }

    // if no token
    if (!$request->query('email_verification_token')) {
      return redirect()->route('auth.sign_in.index')->with('error', 'Invalid token.');
    }

    // get token
    $token = Token::where(['type' => 'email_verification_token', 'token' => $request->query('email_verification_token')])->first();
    // if token does not exist
    if (!$token) {
      return redirect()->route('auth.sign_in.index')->with('error', 'Invalid token.');
    }

    // if token expired
    else if ($token->expires_at < now() && !$token->revoked_at) {
      // set session error
      $request->session()->put('error', 'Token expired.');
    }

    // if token revoked
    else if ($token->revoked_at) {
      $user = $token->user;
      if ($user->email_verified_at) {
        return redirect()->route('auth.sign_in.index')->with('error', 'Token revoked. Your email address has already been verified.');
      }
      return redirect()->route('auth.sign_in.index')->with('error', 'Token revoked.');
    }
    return $next($request);
  }
}
