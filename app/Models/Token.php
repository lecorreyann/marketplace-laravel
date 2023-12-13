<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Token extends Model
{
  use HasFactory;

  public $timestamps = false;

  /**
   * The attributes that are mass assignable.
   * @var array<int, string>
   */
  protected $fillable = [
    'token',
    'type', // remember_token', 'access_token', 'refresh_token', 'email_verification_token', 'password_reset_token'
    'expires_at',
    'revoked_at'
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'crated_at' => 'datetime',
    'expires_at' => 'datetime',
    'revoked_at' => 'datetime',
  ];

  /**
   * Get the user that owns the token.
   * @return BelongsTo
   */
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
