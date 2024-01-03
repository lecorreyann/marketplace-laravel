<?php

/**
 * Namespace for the authentication related Livewire components.
 */

namespace App\Livewire\Auth;

/**
 * Importing required classes and components.
 */

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\User;
use App\Events\AccountCreated as AccountCreatedEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Validation\ValidationException;

/**
 * SignUp component class.
 * This class is responsible for handling user sign up.
 */
class SignUp extends Component
{

  /**
   * @var string $first_name The first name of the user. This field is required.
   */
  #[Validate('required')]
  public $first_name = 'John';

  /**
   * @var string $last_name The last name of the user. This field is required.
   */
  #[Validate('required')]
  public $last_name = 'Doe';

  /**
   * @var string $email The email of the user. This field is required, must be a valid email, and unique among users.
   */
  #[Validate('required|email|unique:users,email')]
  public $email = 'john@doe.com';

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
   * Store the user in the database.
   * This method resets the error bag, validates the input, creates the user, and redirects to the sign in page.
   *
   * @return redirect Redirect to the sign in page.
   */
  public function store()
  {

    // reset error bag
    $this->resetErrorBag();

    // validate input
    $this->validate();

    // create user
    $user = User::create([
      'first_name' => $this->first_name,
      'last_name' => $this->last_name,
      'email' => $this->email,
      'password' => $this->password,
    ]);

    // send account created notification
    AccountCreatedEvent::dispatch($user);

    // redirect to sign in page
    return back()->with('success', 'Your account has been created successfully. We have sent you an email to verify your email address and activate your account, please check your inbox (and spam folder).');
  }
}
