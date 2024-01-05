<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Events\AccountCreated as AccountCreatedEvent;

class SignUpForm extends Form
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
   */
  public function create(): void
  {

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
  }
}
