<?php

namespace App\Livewire\Companies;

use Livewire\Component;
use App\Livewire\Forms\CreateCompanyForm;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;

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


  #[On('updated-country')]
  public function updatedCountry($value)
  {
    //
    $this->form->country = $value;
  }

  #[On('updated-search-company')]
  public function updatedSearchCompany()
  {
    dd('updated');
  }
}
