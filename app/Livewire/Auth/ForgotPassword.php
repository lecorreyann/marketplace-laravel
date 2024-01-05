<?php


namespace App\Livewire\Auth;

use Livewire\Component;
use App\Livewire\Forms\ForgotPasswordForm;

/**
 * ForgotPassword component class.
 * This class is responsible for handling user forgot password.
 */
class ForgotPassword extends Component
{

  public ForgotPasswordForm $form;

  /**
   * Send the password reset link to the user.
   * This method resets the error bag, validates the input, generates a new password reset token, dispatches the request verify email link event, and redirects to the forgot password page.
   *
   * @return redirect Redirect to the forgot password page.
   */
  public function forgot()
  {
    // reset error bag
    $this->resetErrorBag();

    $this->form->sendLink();

    // redirect to sign in page
    return back()->with('success', 'We have sent you an email to reset your password, please check your inbox (and spam folder).');
  }
}
