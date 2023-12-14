<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;

class EnsureRoleIsNotLocked
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    // get role
    $role = Role::find($request->route('role'));

    // if role is locked
    if ($role && $role->locked) {
      return redirect()->route('admin.roles.index')->with('error', 'Role is locked.');
    }

    return $next($request);
  }
}
