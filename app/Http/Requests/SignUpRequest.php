<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
      'first_name' => ['required', 'string', 'max:255', 'regex:/^[a-zÀ-ÿ]+(?:[ \'-][a-zÀ-ÿ]+)*$/i'],
      'last_name' => ['required', 'string', 'max:255', 'regex:/^[a-zÀ-ÿ]+(?:[ \'-][a-zÀ-ÿ]+)*$/i'],
      'email' => ['required', 'email', 'unique:users,email'],
      'password' => ['required', 'min:8', 'confirmed'],
    ];
  }
}
