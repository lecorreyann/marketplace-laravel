<?php

namespace App\Policies;

use App\Models\User;

class CountryPolicy
{

  /**
   * Create a new policy instance.
   */
  public function __construct()
  {
    //
  }


  /**
   * Determine user can list countries.
   */
  public function list(User $user): bool
  {
    return $user->hasOneRoleOf(['super admin', 'admin']) || $user->hasPermission('list countries');
  }

  /**
   * Determine user can update cuntry.
   */
  public function update(User $user): bool
  {
    return $user->hasOneRoleOf(['super admin', 'admin']) || $user->hasPermission('update country');
  }
}
