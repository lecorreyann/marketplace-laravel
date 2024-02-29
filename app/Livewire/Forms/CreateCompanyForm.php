<?php

namespace App\Livewire\Forms;

use App\Enums\CompanyIdentifierType;
use App\Models\Country;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateCompanyForm extends Form
{
  /**
   * @var string $country The country of the company. This field is required.
   */
  #[Validate]
  public string $country;

  #[Validate]
  public string $name;

  #[Validate]
  public string $identifier;

  #[Validate]
  public CompanyIdentifierType $identifierType;

  #[Validate]
  public string $address;

  #[Validate]
  public string $city;

  #[Validate]
  public string $postalCode;

  #[Validate]
  public string $phone;

  public function setName(string $value)
  {
    $this->name = $value;
  }

  public function rules()
  {
    $rules = [
      'country' => ['required'],
      'name' => ['required'],
      'identifier' => ['required'],
      'identifierType' => ['required'],
      'address' => ['required'],
      'city' => ['required'],
      'postalCode' => ['required'],
      'phone' => ['required']
    ];
    $country = Country::find($this->country);
    if ($country['iso_3166-1_alpha-2'] == 'FX') {
      $rules['postalCode'][] = 'digits:5';
    }

    return $rules;
  }
}
