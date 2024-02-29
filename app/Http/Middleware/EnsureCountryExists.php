<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Country;

class EnsureCountryExists
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    // get country
    $country = Country::find($request->route('id'));

    // if country does not exist
    if (!$country) {
      return redirect()->route('admin.countries.index')->with('error', 'Country does not exist.');
    }

    return $next($request);
  }
}
