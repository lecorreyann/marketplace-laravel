<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Permission;

class EnsurePermissionExists
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    // get permission
    $permission = Permission::find($request->route('permission'));

    // if permission does not exist
    if (!$permission) {
      return redirect()->route('admin.permissions.index')->with('error', 'Permission does not exist.');
    }

    return $next($request);
  }
}
