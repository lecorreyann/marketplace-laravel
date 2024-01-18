<?php

namespace App\Livewire\Components;

use App\Enums\SelectType;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;


class Select extends Component
{
  public string $id;
  public string|null $name;
  public string|null $class;
  public string $label;
  public string $model;
  public string|null $value;
  public string $placeholder;
  public string $optionText; // the field to use for the option text
  public string $optionValue; // the field to use for the option value
  public Collection $options;
  public SelectType|null $type;

  public function mount($id, $label, $optionText, $optionValue, $placeholder, $name = null, $class = null, $value = null, $type = null)
  {
    $this->id = $id;
    $this->name = $name;
    $this->class = $class;
    $this->label = $label;
    $this->model = 'App\Models\\' . $this->model;
    $this->optionText = $optionText;
    $this->optionValue = $optionValue;
    $this->options = $this->model::all();
    $this->value = $value;
    $this->placeholder = $placeholder;
    $this->type = $type;
  }



  public function render()
  {
    return view('livewire.components.select');
  }
}
