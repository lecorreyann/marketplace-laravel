<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;


class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'password',
    'email_verified_at'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  /**
   * Get the tokens for the user.
   * @return HasMany
   */
  public function tokens(): HasMany
  {
    return $this->hasMany(Token::class);
  }

  /**
   * Get vaidate email token
   */

  /** Before create */
  protected static function booted()
  {

    // Create a token for email verification
    static::created(function ($user) {
      $user->generateEmailVerificationToken();
    });
  }

  /**
   * Generate new token for email verification
   */
  public function generateEmailVerificationToken(): void
  {
    $this->tokens()->create([
      'type' => 'email_verification_token',
      'token' => hash('sha256', random_bytes(32)),
      'expires_at' => now()->addSeconds(config('token.email_verification_token.expires_in'))
    ]);
  }

  /**
   * Generate new token for password reset
   */
  public function generatePasswordResetToken(): void
  {
    $this->tokens()->create([
      'type' => 'password_reset_token',
      'token' => hash('sha256', random_bytes(32)),
      'expires_at' => now()->addSeconds(config('token.password_reset_token.expires_in'))
    ]);
  }
}
