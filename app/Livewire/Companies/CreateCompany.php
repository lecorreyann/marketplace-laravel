<?php

namespace App\Livewire\Companies;

use App\Enums\CompanyIdentifierType;
use Livewire\Component;
use App\Livewire\Forms\CreateCompanyForm;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use App\Models\Country;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection as SupportCollection;

/**
 * CreateCompany component class.
 * This class is responsible for handling the create company.
 */
class CreateCompany extends Component
{
  public CreateCompanyForm $form;

  public Collection $countries;
  public Collection $disabledCountries;
  public SupportCollection $addresses; // the addresses of establishments
  public bool $customAddress = false;


  public function mount()
  {
    $this->countries = Country::all();
    $this->disabledCountries = $this->countries->where('create_company_select_country_enable', false);
    $this->form->setName('');
    $this->form->setIdentifier('');
  }


  #[On('updated-country')]
  public function updatedCountry($value)
  {
    //
    $this->form->country = collect($value);
  }

  #[On('select-company')]
  public function selectCompany($value)
  {
    $country = $this->form->country;

    if ($country['iso_3166-1_alpha-2'] === 'FX') {
      $this->form->name = $value['nom_complet'];
      $this->form->identifierType = CompanyIdentifierType::siret;
      $establishments = collect(Arr::undot($value)['matching_etablissements']);
      // keep only adresse and siret from etablissements and add id to each item
      $this->addresses = $establishments->map(function ($item, $key) {
        $item['id'] = $key;
        $item['address'] = $item['adresse'];
        $item['identifier'] = $item['siret'];
        $item = Arr::only($item, ['identifier', 'address', 'id']);
        // return $item to object to be able to use it in the view
        return (object) $item;
      });
      // $this->form->address = $value['siege.numero_voie'] . ' ' . $value['siege.type_voie'] . ' ' . $value['siege.libelle_voie'];
      // $this->form->city = $value['siege.libelle_commune'];
      // $this->form->postalCode = $value['siege.code_postal'];
    }
  }

  #[On('select-address')]
  public function selectAddress($value)
  {
    $value = (object) $value;
    if ($value->address === 'other') {
      $this->customAddress = true;
      $this->form->identifier = '';
    } else {
      $this->customAddress = false;
      $this->form->address = $value->address;
      $this->form->identifier = $value->identifier;
    }
  }
}
