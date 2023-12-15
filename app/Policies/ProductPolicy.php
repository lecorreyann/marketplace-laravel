<?php

namespace App\Policies;

use App\Models\User;

class ProductPolicy
{


  /**
   * Determine whether the user can create models.
   */
  public function create(User $user): bool
  {
    // user is super admin or admin
    // or
    // user has company and has permission to create product


    return $user->hasOneRoleOf(['super admin', 'admin']) || ($user->company && $user->hasPermission('create product'));
  }
}
