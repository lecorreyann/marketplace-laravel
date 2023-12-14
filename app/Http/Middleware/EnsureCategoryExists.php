<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Category;

class EnsureCategoryExists
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    // get category
    $category = Category::find($request->route('category'));

    // if category does not exist
    if (!$category) {
      return redirect()->route('admin.categories.index')->with('error', 'Category does not exist.');
    }

    return $next($request);
  }
}
