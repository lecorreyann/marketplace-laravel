<?php

namespace App\Livewire\Forms;

use App\Http\Requests\SignInRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SignInForm extends Form
{
  /**
   * @var string $email The email of the user. This field is required, must be a valid email, and unique among users.
   */
  #[Validate]
  public $email;
  #[Validate]
  public $password;

  /**
   * @var bool $remember Whether to remember the user or not.
   */
  public $remember = false;


  public function setDemoForm(): void
  {
    $this->email = env('DEMO_EMAIL', 'john@doe.com');
    $this->password = env('DEMO_PASSWORD', 'password');
  }

  /**
   * Get the validation rules for the sign in request.
   *
   * @return array The validation rules.
   */
  public function rules()
  {
    // create sign in request
    $request = new SignInRequest();

    // merge email and password (Livewire does not support nested data binding)
    $request->merge([
      'email' => $this->email,
      'password' => $this->password
    ]);

    // return rules
    return $request->rules();
  }

  public function auth()
  {

    // validate input
    $this->validate();

    // attempt to authenticate user
    if (Auth::attempt($this->only('email', 'password'), $this->remember)) {
      session()->regenerate();

      if ($this->remember) {
        // create a new remember token
        $remember_token = Auth::user()->generateRememberToken();

        // save remember token in cookie
        setcookie('remember_me', $remember_token, time() + config('token.remeber_token.expires_in'), '/');
      }
    }
  }
}
