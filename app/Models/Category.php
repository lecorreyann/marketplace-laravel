<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
  use HasFactory, SoftDeletes;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'categories';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'slug',
    'parent_id'
  ];



  /**
   * Could have parent category.
   */
  public function parent(): HasOne
  {
    return $this->hasOne(Category::class, 'parent_id');
  }

  /**
   * Could have children categories.
   */
  public function children(): HasMany
  {
    return $this->hasMany(Category::class, 'parent_id');
  }

  /**
   * Could have products.
   */
  public function products(): HasMany
  {
    return $this->hasMany(Product::class);
  }
}
