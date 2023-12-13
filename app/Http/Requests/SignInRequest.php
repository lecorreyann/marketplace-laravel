<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SignInRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    $user = User::where('email', $this->email)->first();

    return [
      'email' => ['required', 'email', function ($attribute, $value, $fail) use ($user) {
        if (!$user) {
          $fail('The email address is not registered.');
        } else {
          if ($this->input('password') && Hash::check($this->input('password'), $user->password)) {
            if (!$user->email_verified_at) {
              $fail('The email address is not verified.');
            } else if ($user->deleted_at) {
              $fail('The email address is not registered.');
            }
          }
        }
      }],
      'password' => ['required', 'min:8', function ($attribute, $value, $fail) use ($user) {
        if ($user && !Hash::check($value, $user->password)) {
          $fail('The password is incorrect.');
        }
      }],
    ];
  }
}
