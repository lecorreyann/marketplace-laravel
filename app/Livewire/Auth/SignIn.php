<?php

/**
 * Namespace for the authentication related Livewire components.
 */

namespace App\Livewire\Auth;

/**
 * Importing required classes and components.
 */

use App\Http\Requests\SignInRequest;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

/**
 * SignIn component class.
 * This class is responsible for handling user sign in.
 */
class SignIn extends Component
{
  /**
   * @var string $email The email of the user. This field is required, must be a valid email, and unique among users.
   */
  public $email = 'john@doe.com';

  /**
   * @var string $password The password of the user. This field is required.
   */
  public $password = 'password';

  /**
   * @var bool $remember Whether to remember the user or not.
   */
  public $remember = false;


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

  /**
   * Store the authenticated user in the session.
   * This method resets the error bag, attempts to authenticate the user, regenerates the session, and redirects to the home route.
   *
   * @return redirect Redirect to the home route.
   */
  public function store()
  {
    // reset error bag
    $this->resetErrorBag();

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
    // authentication passed
    return redirect()->intended(route('home'));
  }
}
