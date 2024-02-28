<?php

namespace App\Livewire\Companies;

use App\Enums\CompanyIdentifierType;
use Livewire\Component;
use App\Livewire\Forms\CreateCompanyForm;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use App\Models\Country;

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
    $this->countries = Country::all();
    $this->form->setCompanyName('');
  }


  #[On('updated-country')]
  public function updatedCountry($value)
  {
    //
    $this->form->country = $value;
  }

  #[On('updated-company')]
  public function updatedCompany($value)
  {
    $country = Country::find($this->form->country);
    if ($country['iso_3166-1_alpha-2'] === 'FX') {
      $this->form->companyName = $value['nom_complet'];
      $this->form->companyIdentifier = $value['siren'];
      $this->form->companyIdentifierType = CompanyIdentifierType::siren;
    }
  }
}
