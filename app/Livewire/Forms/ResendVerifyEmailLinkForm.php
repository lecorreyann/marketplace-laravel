<?php

namespace App\Livewire\Forms;

use App\Http\Requests\VerifyEmailRequest;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Events\RequestVerifyEmailLink as RequestVerifyEmailLinkEvent;

class ResendVerifyEmailLinkForm extends Form
{
  /**
   * @var string $email The email of the user. This field is required, must be a valid email, and unique among users.
   */
  #[Validate]
  public $email;

  /**
   * Get the validation rules for the sign in request.
   *
   * @return array The validation rules.
   */
  public function rules()
  {
    // create sign in request
    $request = new VerifyEmailRequest();

    // merge email and password (Livewire does not support nested data binding)
    $request->merge([
      'email' => $this->email
    ]);

    // return rules
    return $request->rules();
  }

  public function sendLink()
  {
    // validate input
    $this->validate();

    // get user by email
    $user = User::where('email', $this->email)->first();

    // generate new email verification token
    $user->generateEmailVerificationToken();

    // dispatch request verify email link event
    RequestVerifyEmailLinkEvent::dispatch($user);
  }
}
