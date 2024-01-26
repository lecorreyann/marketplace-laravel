<?php

namespace App\Livewire\Companies;

use Livewire\Component;
use App\Livewire\Forms\CreateCompanyForm;
use Illuminate\Database\Eloquent\Collection;

/**
 * CreateCompany component class.
 * This class is responsible for handling the create company.
 */
class CreateCompany extends Component
{
  public CreateCompanyForm $form;

  public Collection $countries;

  public function mount()
  {
    $this->countries = \App\Models\Country::all();
  }
}
