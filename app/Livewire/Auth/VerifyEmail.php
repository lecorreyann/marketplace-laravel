<?php


namespace App\Livewire\Auth;

use Livewire\Component;
use App\Livewire\Forms\ResendVerifyEmailLinkForm;
use App\Models\Token;

/**
 * VerifyEmail component class.
 * This class is responsible for handling user verify email.
 */
class VerifyEmail extends Component
{

  public ResendVerifyEmailLinkForm $form;

  /**
   * @var string $email_verification_token The password reset token of the user.
   */
  public $email_verification_token;

  /**
   * Get the query string for the component.
   * @var string[]
   */
  protected $queryString = [
    'email_verification_token'
  ];


  public function rendering()
  {
    // if session error !== 'Token expired.' && !session success (Only handle if token is valid)
    if (!session()->has('error') && !session()->has('success')) {

      // get email verification token
      $token = Token::where(['type' => 'email_verification_token', 'token' => $this->email_verification_token])->firstOrFail();

      // get user
      $user = $token->user;

      // update user
      $user->update([
        'email_verified_at' => now(),
      ]);

      // revoke email verification token
      $token->update([
        'revoked_at' => now(),
      ]);

      // log user in
      auth()->login($user);

      // redirect to home page
      return redirect()->route('home')->with('success', 'Your email address has been verified successfully.');
    }
  }

  /**
   * Store the authenticated user in the session.
   * This method resets the error bag, attempts to authenticate the user, regenerates the session, and redirects to the home route.
   *
   * @return redirect Redirect to the home route.
   */
  public function resendLink()
  {
    // reset error bag
    $this->resetErrorBag();

    $this->form->sendLink();

    // delete session error
    session()->forget('error');

    // redirect to verify email page
    return back()->with('success', 'We have sent you an email to verify your email address, please check your inbox (and spam folder).');
  }
}
