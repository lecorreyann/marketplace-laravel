<?php

namespace App\Livewire\Forms;

use App\Http\Requests\ForgotPasswordRequest;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Events\RequestResetPasswordLink as RequestResetPasswordLinkEvent;

class ForgotPasswordForm extends Form
{
  /**
   * @var string $email The email of the user. This field is required, must be a valid email, and unique among users.
   */
  #[Validate]
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

  public function sendLink(): void
  {
    // validate input
    $this->validate();

    // get user by email
    $user = User::where('email', $this->email)->first();

    // generate new password reset token
    $user->generatePasswordResetToken();

    // dispatch request verify email link event
    RequestResetPasswordLinkEvent::dispatch($user);
  }
}
