<?php

namespace App\Livewire\Admin\Countries;

use App\Livewire\Forms\EditCountryForm;
use Livewire\Component;
use App\Models\Country;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class EditCountry extends Component
{

  public EditCountryForm $form;




  public function mount($id)
  {
    $this->form->setCountry(Country::find($id));
  }

  public function update()
  {
    $this->form->update();
    return redirect()->route('admin.country.edit', $this->form->country->id)->with('success', 'Country updated successfully');
  }

  public function render()
  {
    return view('livewire.admin.countries.edit');
  }
}
