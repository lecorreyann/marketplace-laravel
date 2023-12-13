<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class CRUDController extends Controller
{
  /**
   * Display a listing of the resource.
   * @return View
   */
  public function index(): View
  {
    return view('category.index', [
      'categories' => Category::all()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   * @return View
   */
  public function create(): View
  {
    return view('category.create', [
      'categories' => Category::all()
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreCategoryRequest $request): RedirectResponse
  {

    Category::create([
      'name' => $request->name,
      'slug' => $request->slug,
      'parent_id' => $request->parent_id,
    ]);

    // redirect to index page
    return to_route('admin.categories.index')->with('success', 'Category created successfully.');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id): View
  {
    return view('category.edit', [
      'category' => Category::find($id),
      'categories' => Category::where('id', '!=', $id)->get()
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateCategoryRequest $request, string $id): RedirectResponse
  {
    Category::find($id)->update([
      'name' => $request->name,
      'slug' => $request->slug,
      'parent_id' => $request->parent_id,
    ]);

    // redirect to index page
    return to_route('admin.categories.index')->with('success', 'Category updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id): RedirectResponse
  {
    Category::find($id)->delete();

    // redirect to index page
    return to_route('admin.categories.index')->with('success', 'Category deleted successfully.');
  }
}
