<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
  /**
   * Create a new component instance.
   */
  public function __construct(
    public string $label,
    public string $id,
    public string $type,
    public string $name,
    public string $placeholder = '',
    public int|null $debounce = null,
    public string|null $autocomplete = null,
    public string|null $description = null,
  ) {
    //
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.forms.input');
  }
}
