<?php

namespace App\Livewire\Components;

use App\Enums\SelectType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\On;
use Livewire\Component;


class Select extends Component
{
  public string $id;
  public string $name;
  public string|null $class;
  public string $label;
  public string $placeholder;
  public string $optionText; // the field to use for the option text
  public string $optionValue; // the field to use for the option value
  public Collection|SupportCollection $options;
  public SelectType|null $type;
  public bool $disabled;
  public bool $otherOptionEnabled = false; // if true, the select will have an "other" option
  public mixed $selectedOption = null;

  public function mount($id, $label, $options,  $optionText, $optionValue, $placeholder, $disabled = false, $otherOptionEnabled = false, $name = null, $class = null, $type = null, $selectedOption = null)
  {
    $this->id = $id;
    $this->name = $name;
    $this->class = $class;
    $this->label = $label;
    $this->optionText = $optionText;
    $this->optionValue = $optionValue;
    $this->options = $options;
    $this->placeholder = $placeholder;
    $this->type = $type;
    $this->disabled = $disabled;
    $this->otherOptionEnabled = $otherOptionEnabled;
    $this->selectedOption = $selectedOption;
  }

  public function updatedOptions()
  {
    dump('ici');
  }

  #[Computed]
  public function options()
  {
    if ($this->otherOptionEnabled === true) {
      $optionValue = count($this->options) + 1;
      if ($this->optionValue !== 'id') {
        $optionValue = 'other';
      }
      $this->options->push((object) [
        $this->optionText => 'other',
        $this->optionValue => $optionValue
      ]);
    }
    return $this->options;
  }

  // update selected option
  #[On('updated-value')]
  public function setSelectedOption($value)
  {
    if (!isset($value->disabled) || (isset($value->disabled) && $value->disabled === false)) {
      $this->selectedOption = $value;
    }
  }


  public function render()
  {
    return view('livewire.components.select');
  }
}
