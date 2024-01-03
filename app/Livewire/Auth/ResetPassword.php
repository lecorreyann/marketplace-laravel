<?php

/**
 * Namespace for the authentication related Livewire components.
 */

namespace App\Livewire\Auth;

/**
 * Importing required classes and components.
 */

use Livewire\Component;
use App\Models\Token;
use Livewire\Attributes\Validate;
use App\Events\PasswordReset as PasswordResetEvent;

/**
 * ResetPassword component class.
 * This class is responsible for handling user forgot password.
 */
class ResetPassword extends Component
{
  /**
   * @var string $password The password of the user. This field is required and must be confirmed.
   */
  #[Validate('required|confirmed')]
  public $password = 'password';

  /**
   * @var string $password_confirmation The password confirmation of the user. This field is required.
   */
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


  /**
   * Reset the password of the user.
   *
   * This method resets the error bag, validates the input, get token by password reset token,
   * get user by token, update user, revoke password reset token,
   * dispatches the password reset event, and redirects to the reset password page.
   *
   * @return redirect Redirect to the reset password page.
   */
  public function update()
  {

    // reset error bag
    $this->resetErrorBag();

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

    // redirect to verify email page
    return back()->with('success', 'Your password has been reset. You can now sign in with your new password.');
  }
}
