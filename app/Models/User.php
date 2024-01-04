<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRelationships;

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
   * Booted method
   */
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

  /**
   * Generate new remember token
   *
   * @return string The remember token.
   */
  public function generateRememberToken(): string
  {
    $remember_token = $this->tokens()->create([
      'type' => 'remember_token',
      'token' => hash('sha256', random_bytes(32)),
      'expires_at' => now()->addSeconds(config('token.remember_token.expires_in'))
    ]);

    return $remember_token->token;
  }

  /**
   * Get the remember token associated with the user.
   */
  public function rememberToken(): HasOne
  {
    return $this->hasOne(Token::class)->where(['type' => 'remember_token', 'revoked_at' => null]);
  }

  /**
   * Get the remember token for the user.
   */
  public function getRememberToken()
  {
    // if remember token is not set
    if (!$this->rememberToken) {
      return null;
    }
    return $this->rememberToken->token;
  }

  /**
   * Get the column name for the "remember me" token.
   */
  public function getRememberTokenName(): string
  {
    return 'tokens.token';
  }

  /**
   * Set the remember token for the user.
   */
  public function setRememberToken($value): void
  {
    $this->generateRememberToken();
  }

  /**
   * The roles that belong to the user.
   */
  public function roles(): BelongsToMany
  {
    return $this->belongsToMany(Role::class);
  }

  /**
   * The permissions that belong to the user through roles.
   */
  public function permissions(): HasManyDeep
  {
    // get all permissions of user roles
    return $this->hasManyDeep(Permission::class, ['role_user', Role::class, 'permission_role']);
  }

  /**
   * Check if user has a role
   * @param string $role
   * @return bool
   */
  public function hasRole(string $role): bool
  {
    return $this->roles()->where('roles.name', $role)->exists();
  }

  /**
   * Check if user has one of the roles
   * @param array $roles
   * @return bool
   */
  public function hasOneRoleOf(array $roles): bool
  {
    return $this->roles()->whereIn('roles.name', $roles)->exists();
  }

  /**
   * Check if user has a permission
   * @param string $permission
   * @return bool
   */
  public function hasPermission(string $permission): bool
  {
    return $this->permissions()->where('permissions.name', $permission)->exists();
  }

  /**
   * Check if user has one of the permissions
   * @param array $permissions
   * @return bool
   */
  public function hasOnePermissionOf(array $permissions): bool
  {
    return $this->permissions()->whereIn('permissions.name', $permissions)->exists();
  }

  /**
   * Get the company that owns the user.
   */
  public function company(): HasOne
  {
    return $this->hasOne(Company::class);
  }

  /**
   * Get the addresses associated with the company.
   */
  public function addresses(): HasMany
  {
    return $this->hasMany(Address::class);
  }
}
