<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    /**
     * Assign permissions to roles
     */
    $roles = DB::table('roles')->get();
    $permissions = DB::table('permissions')->get();

    /**
     * Super admin permissions
     */
    // add '*' permission to 'super admin' role
    $role = $roles->where('name', 'super admin')->first();
    $permission = $permissions->where('name', '*')->first();
    if ($role && $permission) {
      DB::table('permission_role')->insert([
        'role_id' => $role->id,
        'permission_id' => $permission->id,
      ]);
    }

    /**
     * Admin permissions
     */
    // add 'create category' permission to 'admin' role
    $role = $roles->where('name', 'admin')->first();
    $permissions_to_add = [
      'create category',
      'update category',
      'delete category',
      'update country',
      'update city'
    ];
    if ($role) {
      foreach ($permissions_to_add as $permission_to_add) {
        $permission = $permissions->where('name', $permission_to_add)->first();
        if ($permission) {
          DB::table('permission_role')->insert([
            'role_id' => $role->id,
            'permission_id' => $permission->id,
          ]);
        }
      }
    }

    /**
     * User permissions
     */
    $role = $roles->where('name', 'user')->first();
    $permissions_to_add = [];
    if ($role) {
      foreach ($permissions_to_add as $permission_to_add) {
        $permission = $permissions->where('name', $permission_to_add)->first();
        if ($permission) {
          DB::table('permission_role')->insert([
            'role_id' => $role->id,
            'permission_id' => $permission->id,
          ]);
        }
      }
    }

    /**
     * Vendor permissions
     */
    $role = $roles->where('name', 'vendor')->first();
    $permissions_to_add = [
      'create product',
      'read product',
      'update product',
      'delete product'
    ];
    if ($role) {
      foreach ($permissions_to_add as $permission_to_add) {
        $permission = $permissions->where('name', $permission_to_add)->first();
        if ($permission) {
          DB::table('permission_role')->insert([
            'role_id' => $role->id,
            'permission_id' => $permission->id,
          ]);
        }
      }
    }
  }
}
