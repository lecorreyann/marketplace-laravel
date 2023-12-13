<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
  use HasFactory, SoftDeletes;

  /**
   * The roles that belong to the permission.
   */
  public function roles(): BelongsToMany
  {
    return $this->belongsToMany(Role::class);
  }
}
