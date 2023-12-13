<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
    // if slug is empty
    if (empty($this->slug)) {
      // generate slug from name
      $this->merge([
        'slug' => Str::slug($this->name)
      ]);
    } else {
      // generate slug from slug
      $this->merge([
        'slug' => Str::slug($this->slug)
      ]);
    }

    return [
      //
      'name' => ['required', 'string', 'max:255'],
      'slug' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore(request()->route('category'))]
    ];
  }
}
