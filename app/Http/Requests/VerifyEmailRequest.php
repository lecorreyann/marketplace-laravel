<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class VerifyEmailRequest extends FormRequest
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
    return [
      'email' => ['required', 'email', 'exists:users,email', function ($attribute, $value, $fail) {
        $user = User::where('email', $value)->first();
        if ($user && $user->email_verified_at) {
          $fail('The email address has already been verified.');
        }
      }]
    ];
  }
}
