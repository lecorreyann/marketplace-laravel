<?php

// Path: routes/companies.php

use App\Livewire\Admin\Countries\EditCountry;
use App\Livewire\Admin\Countries\IndexCountry;
use App\Http\Middleware\EnsureCountryExists;
use App\Models\Country;
use Illuminate\Support\Facades\Route;

// Country Routes (CRUD)
Route::middleware([])->group(function () {
  Route::get('/countries', IndexCountry::class)->name('countries.index')->can('list', Country::class);;
  Route::name('country.')->prefix('/countries')->group(function () {
    Route::get('/{id}/edit', EditCountry::class)->middleware([EnsureCountryExists::class])->name('edit')->can('update', Country::class);
    Route::patch('/{id}/update', EditCountry::class)->middleware([EnsureCountryExists::class])->name('update')->can('update', Country::class);
  });
});
