<?php

namespace App\Livewire\Forms;

use App\Models\Token;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Events\PasswordReset as PasswordResetEvent;

class ResetPasswordForm extends Form
{
  /**
   * @var string $password The password of the user. This field is required and must be confirmed.
   */
  #[Validate('required|confirmed')]
  public $password = 'password';

  /**
   * @var string $password_confirmation The password confirmation of the user. This field is required.
   */
  #[Validate]
  public $password_confirmation = 'password';

  /**
   * @var string $password_reset_token The password reset token of the user.
   */
  public $password_reset_token;

  /**
   * Get the query string for the component.
   * @var string[]
   */
  protected $queryString = [
    'password_reset_token'
  ];

  public function resetPassword(): void
  {
    // validate input
    $this->validate();

    // token
    $token = Token::where(['type' => 'password_reset_token', 'token' => $this->password_reset_token])->firstOrFail();

    // get user by email
    $user = $token->user;

    // update user
    $user->update([
      'password' => $this->password,
    ]);

    // revoke password reset token
    $token->update([
      'revoked_at' => now(),
    ]);

    // dispatch request verify email link event
    PasswordResetEvent::dispatch($user);
  }
}
