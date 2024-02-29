<?php

namespace App\Livewire\Admin\Countries;

use Livewire\Component;
use App\Models\Country;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class EditCountry extends Component
{
  public $country;
  public $name;

  public function mount($id)
  {
    $this->country = Country::find($id);
    $this->name = $this->country->name;
  }

  public function update()
  {
    $this->validate([
      'name' => 'required',
      'code' => 'required',
    ]);

    $this->country->update([
      'name' => $this->name,
      'code' => $this->code,
    ]);

    session()->flash('message', 'Country updated successfully.');

    return redirect()->route('admin.countries.index');
  }

  public function render()
  {
    return view('livewire.admin.countries.edit');
  }
}
