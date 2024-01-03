<?php

/**
 * Namespace for the authentication related Livewire components.
 */

namespace App\Livewire\Auth;

/**
 * Importing required classes and components.
 */

use App\Http\Requests\ForgotPasswordRequest;
use Livewire\Component;
use App\Models\User;
use App\Events\RequestResetPasswordLink as RequestResetPasswordLinkEvent;

/**
 * ForgotPassword component class.
 * This class is responsible for handling user forgot password.
 */
class ForgotPassword extends Component
{
  /**
   * @var string $email The email of the user. This field is required, must be a valid email, and unique among users.
   */
  public $email;


  /**
   * Get the validation rules for the forgot password request.
   *
   * @return array The validation rules.
   */
  public function rules()
  {
    // create the forgot password request
    $request = new ForgotPasswordRequest();

    // merge email and password (Livewire does not support nested data binding)
    $request->merge([
      'email' => $this->email
    ]);

    // return rules
    return $request->rules();
  }

  /**
   * Send the password reset link to the user.
   * This method resets the error bag, validates the input, generates a new password reset token, dispatches the request verify email link event, and redirects to the forgot password page.
   *
   * @return redirect Redirect to the forgot password page.
   */
  public function store()
  {
    // reset error bag
    $this->resetErrorBag();

    // validate input
    $this->validate();

    // get user by email
    $user = User::where('email', $this->email)->first();

    // generate new password reset token
    $user->generatePasswordResetToken();

    // dispatch request verify email link event
    RequestResetPasswordLinkEvent::dispatch($user);

    // redirect to sign in page
    return back()->with('success', 'We have sent you an email to reset your password, please check your inbox (and spam folder).');
  }
}
