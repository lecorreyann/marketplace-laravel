<?php

namespace App\Livewire\Forms;

use App\Models\Country;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditCountryForm extends Form
{
  public Country $country;



  #[Validate]
  public string $name;

  #[Validate('boolean')]
  public bool $create_company_select_country_enable = false;

  #[Validate('boolean')]
  public bool $create_company_input_phone_enable = false;



  public function setCountry(Country $country)
  {
    $this->country = $country;
    $this->name = $this->country->name;
    $this->create_company_input_phone_enable = $this->country->create_company_input_phone_enable;
    $this->create_company_select_country_enable = $this->country->create_company_select_country_enable;
  }



  public function update()
  {
    $this->country->update([
      'create_company_select_country_enable' => $this->create_company_select_country_enable,
      'create_company_input_phone_enable' => $this->create_company_input_phone_enable
    ]);
  }
}
