<?php

// Path: routes/items.php

use App\Http\Middleware\EnsureUserHasCompany;
use App\Livewire\Items\CreateItem;
use Illuminate\Support\Facades\Route;

Route::name('items.')->group(function () {

  // route to create item
  Route::middleware(['auth', EnsureUserHasCompany::class])->get('/items/create', CreateItem::class)->name('create');
});
