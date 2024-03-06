<?php

namespace App\Livewire\Components;

use App\Enums\SelectType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
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
  public mixed $disabledOptions = null;
  public bool $otherOptionEnabled = false; // if true, the select will have an "other" option
  public mixed $selectedOption = null;

  public function mount($id, $label, $options,  $optionText, $optionValue, $placeholder, $disabled = false, $otherOptionEnabled = false, $disabledOptions = null, $name = null, $class = null, $type = null, $selectedOption = null)
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
    $this->disabledOptions = $disabledOptions === null ? collect([]) : $disabledOptions;
    $this->otherOptionEnabled = $otherOptionEnabled;
    $this->selectedOption = $selectedOption;

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
  }

  // update selected option
  #[On('updated-value')]
  public function setSelectedOption($value)
  {
    if (!$this->disabledOptions->containsStrict($value)) {
      $this->selectedOption = $value;
    }
  }


  public function render()
  {
    return view('livewire.components.select');
  }
}
