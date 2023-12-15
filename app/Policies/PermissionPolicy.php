<?php

namespace App\Policies;

use App\Models\User;

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
    return $user->hasOneRoleOf(['super admin', 'admin']) || $user->hasPermission('create permission');
  }

  /**
   * Determine user can update permision.
   */
  public function update(User $user): bool
  {
    return $user->hasOneRoleOf(['super admin', 'admin']) || $user->hasPermission('update permission');
  }
}
