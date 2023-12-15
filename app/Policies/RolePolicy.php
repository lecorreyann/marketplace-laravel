<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{

  /**
   * Create a new policy instance.
   */
  public function __construct()
  {
    //
  }

  /**
   * Determine user can create role.
   */
  public function create(User $user): bool
  {
    return $user->hasOneRoleOf(['super admin', 'admin']) || $user->hasPermission('create role');
  }

  /**
   * Determine user can update role.
   */
  public function update(User $user): bool
  {
    return $user->hasOneRoleOf(['super admin', 'admin']) || $user->hasPermission('update role');
  }
}
