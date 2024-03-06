<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
  use HasFactory;

  /**
   * The table associated with the model.
   */
  protected $table = 'countries';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'create_company_select_country_enable',
    'create_company_input_phone_enable'
  ];
}
