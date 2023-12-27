<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
  use HasFactory;

  /**
   * Get the user that owns the company.
   */
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  /**
   * Get the addresses associated with the company.
   */
  public function addresses(): HasMany
  {
    return $this->hasMany(Address::class);
  }

  /**
   * Get the products associated with the company.
   */
  public function products(): HasMany
  {
    return $this->hasMany(Product::class);
  }
}