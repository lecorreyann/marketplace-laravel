<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class SearchValueForm extends Form
{

  /**
   * @var string $searchValue The value of the search input. This field is required.
   */
  #[Validate('required|min:5')]
  public string $searchValue;
}
