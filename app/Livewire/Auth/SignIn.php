<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\SignInForm;
use Livewire\Component;

/**
 * SignIn component class.
 * This class is responsible for handling user sign in.
 */
class SignIn extends Component
{

  public SignInForm $form;

  /**
   * Store the authenticated user in the session.
   * This method resets the error bag, attempts to authenticate the user, regenerates the session, and redirects to the home route.
   *
   * @return redirect Redirect to the home route.
   */
  public function signIn()
  {
    // reset error bag
    $this->resetErrorBag();

    $this->form->auth();

    // authentication passed
    return redirect()->intended(route('home'));
  }
}
