<?php

namespace App\Http\Controllers\Country;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCountryRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Country;

class CRUDController extends Controller
{
  /**
   * Display a listing of the resource.
   * @return View
   */
  public function index(): View
  {
    return view('country.index', [
      'countries' => Country::all()
    ]);
  }


  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id): View
  {
    return view('country.edit', [
      'country' => Country::find($id)
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateCountryRequest $request, string $id): RedirectResponse
  {
    // activate country
    $request->merge(['activated' => $request->activated ? true : false]);



    // update contry
    Country::find($id)->update([
      'activated' => $request->activated,
    ]);


    // redirect to index page
    return to_route('admin.countries.index')->with('success', 'Country updated successfully.');
  }
}
