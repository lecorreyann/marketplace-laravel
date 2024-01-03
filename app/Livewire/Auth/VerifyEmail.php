<?php

/**
 * Namespace for the authentication related Livewire components.
 */

namespace App\Livewire\Auth;

/**
 * Importing required classes and components.
 */

use App\Http\Requests\VerifyEmailRequest;
use Livewire\Component;
use App\Models\User;
use App\Events\RequestVerifyEmailLink as RequestVerifyEmailLinkEvent;
use App\Models\Token;

/**
 * VerifyEmail component class.
 * This class is responsible for handling user sign in.
 */
class VerifyEmail extends Component
{
  /**
   * @var string $email The email of the user. This field is required, must be a valid email, and unique among users.
   */
  public $email;

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
  public function store()
  {
    // reset error bag
    $this->resetErrorBag();

    // validate input
    $this->validate();

    // get user by email
    $user = User::where('email', $this->email)->first();

    // generate new email verification token
    $user->generateEmailVerificationToken();

    // dispatch request verify email link event
    RequestVerifyEmailLinkEvent::dispatch($user);

    // delete session error
    session()->forget('error');

    // redirect to verify email page
    return back()->with('success', 'We have sent you an email to verify your email address, please check your inbox (and spam folder).');
  }
}
