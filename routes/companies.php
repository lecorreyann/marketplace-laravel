<?php

// Path: routes/companies.php

use App\Livewire\Companies\CreateCompany;
use Illuminate\Support\Facades\Route;

Route::name('companies.')->group(function () {

  // route to create company
  Route::middleware(['auth'])->get('/companies/create', CreateCompany::class)->name('create');
});
