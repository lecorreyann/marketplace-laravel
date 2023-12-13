<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Token;

class EnsurePasswordResetTokenIsValid
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
    if (!$request->query('password_reset_token')) {
      return redirect()->route('auth.sign_in.index')->with('error', 'Invalid token.');
    }

    // get token
    $token = Token::where(['type' => 'password_reset_token', 'token' => $request->query('password_reset_token')])->first();

    // if token does not exist
    if (!$token) {
      return redirect()->route('auth.sign_in.index')->with('error', 'Invalid token.');
    }

    // if token revoked
    else if ($token->revoked_at) {
      return redirect()->route('auth.sign_in.index')->with('error', 'Token revoked.');
    }

    // if token expired
    else if ($token->expires_at < now() && !$token->revoked_at) {
      return redirect()->route('auth.forgot_password.index')->with('error', 'Token expired.');
    }


    return $next($request);
  }
}
