<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
  use HasFactory;

  /**
   * Get the category that owns the product.
   */
  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }

  /**
   * Get the company that owns the product.
   */
  public function company(): BelongsTo
  {
    return $this->belongsTo(Company::class);
  }
}
