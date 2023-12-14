<?php

namespace App\Http\Controllers\Permission;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Models\Role;

class CRUDController extends Controller
{
  /**
   * Display a listing of the resource.
   * @return View
   */
  public function index(): View
  {
    return view('permission.index', [
      'permissions' => Permission::all()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   * @return View
   */
  public function create(): View
  {
    return view('permission.create', [
      'roles' => Role::all()
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StorePermissionRequest $request): RedirectResponse
  {

    Permission::create([
      'name' => $request->name
    ]);

    // redirect to index page
    return to_route('admin.permissions.index')->with('success', 'Permission created successfully.');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id): View
  {
    return view('permission.edit', [
      'permission' => Permission::find($id),
      'roles' => Role::all()
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdatePermissionRequest $request, string $id): RedirectResponse
  {
    Permission::find($id)->update([
      'name' => $request->name
    ]);

    // redirect to index page
    return to_route('admin.permissions.index')->with('success', 'Permission updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id): RedirectResponse
  {
    Permission::find($id)->delete();

    // redirect to index page
    return to_route('admin.permissions.index')->with('success', 'Permission deleted successfully.');
  }
}
