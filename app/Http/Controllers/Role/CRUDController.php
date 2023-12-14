<?php

namespace App\Http\Controllers\Role;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Models\Permission;

class CRUDController extends Controller
{
  /**
   * Display a listing of the resource.
   * @return View
   */
  public function index(): View
  {
    return view('role.index', [
      'roles' => Role::all()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   * @return View
   */
  public function create(): View
  {
    return view('role.create', [
      'permissions' => Permission::all()
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreRoleRequest $request): RedirectResponse
  {
    // create role
    $role = Role::create([
      'name' => $request->name,
      'permissions' => $request->permissions
    ]);

    // attach permissions to role
    $role->permissions()->attach($request->permissions);

    // redirect to index page
    return to_route('admin.roles.index')->with('success', 'Role created successfully.');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id): View
  {
    return view('role.edit', [
      'role' => Role::find($id),
      'permissions' => Permission::all()
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateRoleRequest $request, string $id): RedirectResponse
  {
    // retrieve role
    $role = Role::find($id);

    // update role
    $role->update([
      'name' => $request->name,
    ]);

    // attach permissions to role
    $role->permissions()->sync($request->permissions);



    // redirect to index page
    return to_route('admin.roles.index')->with('success', 'Role updated successfully.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id): RedirectResponse
  {
    Role::find($id)->delete();

    // redirect to index page
    return to_route('admin.roles.index')->with('success', 'Role deleted successfully.');
  }
}
