<?php

/**
 * Namespace for the authentication related Livewire components.
 */

namespace App\Livewire\Items;

/**
 * Importing required classes and components.
 */

use Livewire\Component;

/**
 * CreateItem component class.
 * This class is responsible for handling user sign in.
 */
class CreateItem extends Component
{
  /**
   * @var string $name The name of the item. This field is required, must be a valid name, and unique among items.
   */
  public $name;

  /**
   * @var string $description The description of the item. This field is required.
   */
  public $description = 'Item Description';

  /**
   * @var string $price The price of the item. This field is required.
   */
  public $price = 'Item Price';
}
