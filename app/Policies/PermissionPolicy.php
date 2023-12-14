<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;

class PermissionPolicy
{

  /**
   * Create a new policy instance.
   */
  public function __construct()
  {
    //
  }

  /**
   * Determine user can create permision.
   */
  public function create(User $user): bool
  {
    $role = Role::where('name', 'admin')->first();
    return $user->hasOneRoleOf(['super admin', 'admin']) || $user->hasPermission('create permission');
  }
}
