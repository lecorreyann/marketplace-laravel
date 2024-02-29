<?php

namespace App\Livewire\Admin\Countries;

use Livewire\Component;
use App\Models\Country;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class IndexCountry extends Component
{
  public $countries;

  public function mount()
  {
    $this->countries = Country::all();
  }

  public function render()
  {
    return view('livewire.admin.countries.index');
  }
}
