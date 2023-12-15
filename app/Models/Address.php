<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Address extends Model
{
  use HasFactory;

  /**
   * The table associated with the model.
   */
  protected $table = 'addresses';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */


  protected $fillable = [];

  /**
   * Get the country
   */
  public function country(): BelongsTo
  {
    return $this->belongsTo(Country::class);
  }

  /**
   * Get the city
   */
  public function city(): BelongsTo
  {
    return $this->belongsTo(City::class);
  }
}
