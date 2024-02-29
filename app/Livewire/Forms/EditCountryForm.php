<?php

namespace App\Livewire\Forms;

use App\Enums\CompanyIdentifierType;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditCountryForm extends Form
{
  /**
   * @var string $country The country of the company. This field is required.
   */
  #[Validate]
  public string $country;

  #[Validate]
  public string $companyName;

  #[Validate]
  public string $companyIdentifier;

  #[Validate]
  public CompanyIdentifierType $companyIdentifierType;

  public function setCompanyName(string $value)
  {
    $this->companyName = $value;
  }
}
