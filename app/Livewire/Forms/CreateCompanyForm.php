<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateCompanyForm extends Form
{
  /**
   * @var string $country The country of the company. This field is required.
   */
  #[Validate]
  public string $country;
}
