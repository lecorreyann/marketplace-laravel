<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Livewire\Forms\ResetPasswordForm;

/**
 * ResetPassword component class.
 * This class is responsible for handling user reset password.
 */
class ResetPassword extends Component
{

  public ResetPasswordForm $form;

  /**
   * Reset the password of the user.
   *
   * @return redirect Redirect to the reset password page.
   */
  public function resetPassword()
  {

    // reset error bag
    $this->resetErrorBag();

    $this->form->resetPassword();

    // redirect to verify email page
    return back()->with('success', 'Your password has been reset. You can now sign in with your new password.');
  }
}
