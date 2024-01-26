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
  public string|null $value;
  public string $placeholder;
  public string $optionText; // the field to use for the option text
  public string $optionValue; // the field to use for the option value
  public Collection $options;
  public SelectType|null $type;
  public bool $disabled;
  public mixed $disabledOptions = [];

  public function mount($id, $label, $options,  $optionText, $optionValue, $placeholder, $disabled = false, $name = null, $class = null, $value = null, $type = null, $disabledOptions = [])
  {
    $this->id = $id;
    $this->name = $name;
    $this->class = $class;
    $this->label = $label;
    $this->optionText = $optionText;
    $this->optionValue = $optionValue;
    $this->options = $options;
    $this->value = $value;
    $this->placeholder = $placeholder;
    $this->type = $type;
    $this->disabled = $disabled;
    $this->disabledOptions = $disabledOptions;
  }



  public function render()
  {
    return view('livewire.components.select');
  }
}
