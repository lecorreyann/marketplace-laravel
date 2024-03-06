<?php

namespace App\Livewire\Components;

use App\Models\Country;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;


class InputPhone extends Component
{

  public string $inputId;
  public string $inputName;
  public string $selectId;
  public string $selectName;
  public string|null $class;
  public string $label;
  public Collection $countries;


  public function mount($inputId, $inputName, $selectId, $selectName, $label, $class = null)
  {
    $this->inputId = $inputId;
    $this->inputName = $inputName;
    $this->selectId = $selectId;
    $this->selectName = $selectName;
    $this->class = $class;
    $this->label = $label;
    $this->countries = Country::all();
  }

  public function render()
  {
    return view('livewire.components.input-phone');
  }
}
