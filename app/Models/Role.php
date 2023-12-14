<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
  use HasFactory, SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name'
  ];

  /**
   * The users that belong to the role.
   */
  public function users(): BelongsToMany
  {
    return $this->belongsToMany(User::class);
  }

  /**
   * The permissions that belong to the role.
   */
  public function permissions(): BelongsToMany
  {
    return $this->belongsToMany(Permission::class);
  }

  /**
   * Determine if the role has the given permission.
   */
  public function hasPermission(string $permission): bool
  {
    return $this->permissions->contains('name', $permission);
  }
}
