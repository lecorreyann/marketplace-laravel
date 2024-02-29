<?php

// Path: routes/web.php


// Category Controllers
// use App\Http\Controllers\Category\CRUDController as CategoryCRUDController;

// Role Controllers
use App\Http\Controllers\Role\CRUDController as RoleCRUDController;

// Permission Controllers
use App\Http\Controllers\Permission\CRUDController as PermissionCRUDController;

// Country Controllers
use App\Http\Livewire\Admin\Countries\EditCountry;
use App\Http\Livewire\Admin\Countries\IndexCountry;
use App\Http\Middleware\EnsureCountryExists;

// use App\Http\Middleware\EnsureCategoryExists;
use App\Http\Middleware\EnsureRoleExists;
use App\Http\Middleware\EnsurePermissionExists;
use App\Http\Middleware\EnsurePermissionIsNotLocked;
use App\Http\Middleware\EnsureRoleIsNotLocked;
use Illuminate\Support\Facades\Route;
// use App\Models\Category;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Country;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// import auth routes
require __DIR__ . '/auth.php';

// import item routes
require __DIR__ . '/items.php';

// import company routes
require __DIR__ . '/companies.php';

Route::get('/', function () {
  return view('home');
})->name('home');


/*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
|
| Here is where you can register category routes for your application.
|
*/
Route::name('category.')->group(function () {
});




/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application.
|
*/
Route::name('admin.')->prefix('/admin')->group(function () {

  // import company routes
  require __DIR__ . '/admin/countries.php';

  // // Category Routes (CRUD)
  // Route::middleware([])->group(function () {
  //   Route::get('/categories', [CategoryCRUDController::class, 'index'])->name('categories.index')->can('list', Category::class);
  //   Route::name('category.')->prefix('/categories')->group(function () {
  //     Route::get('/create', [CategoryCRUDController::class, 'create'])->name('create')->can('create', Category::class);
  //     Route::post('/store', [CategoryCRUDController::class, 'store'])->name('store')->can('create', Category::class);
  //     Route::get('/{category}/edit', [CategoryCRUDController::class, 'edit'])->middleware(EnsureCategoryExists::class)->name('edit')->can('update', Category::class);
  //     Route::patch('/{category}/update', [CategoryCRUDController::class, 'update'])->middleware(EnsureCategoryExists::class)->name('update')->can('update', Category::class);
  //     Route::delete('/{category}/destroy', [CategoryCRUDController::class, 'destroy'])->name('destroy')->can('delete', Category::class);
  //   });
  // });
  // Role Routes (CRUD)
  Route::middleware([])->group(function () {
    Route::get('/roles', [RoleCRUDController::class, 'index'])->name('roles.index')->can('list', Role::class);
    Route::name('role.')->prefix('/roles')->group(function () {
      Route::get('/create', [RoleCRUDController::class, 'create'])->name('create')->can('create', Role::class);
      Route::post('/store', [RoleCRUDController::class, 'store'])->name('store')->can('create', Role::class);
      Route::get('/{role}/edit', [RoleCRUDController::class, 'edit'])->middleware([EnsureRoleExists::class, EnsureRoleIsNotLocked::class])->name('edit')->can('update', Role::class);
      Route::patch('/{role}/update', [RoleCRUDController::class, 'update'])->middleware(EnsureRoleExists::class, EnsureRoleIsNotLocked::class)->name('update')->can('update', Role::class);
      Route::delete('/{role}/destroy', [RoleCRUDController::class, 'destroy'])->name('destroy')->can('delete', Role::class);
    });
  });
  // Permission Routes (CRUD)
  Route::middleware([])->group(function () {
    Route::get('/permissions', [PermissionCRUDController::class, 'index'])->name('permissions.index')->can('list', Permission::class);
    Route::name('permission.')->prefix('/permissions')->group(function () {
      Route::get('/create', [PermissionCRUDController::class, 'create'])->name('create')->can('create', Permission::class);
      Route::post('/store', [PermissionCRUDController::class, 'store'])->name('store')->can('create', Permission::class);
      Route::get('/{permission}/edit', [PermissionCRUDController::class, 'edit'])->middleware([EnsurePermissionExists::class, EnsurePermissionIsNotLocked::class])->name('edit')->can('update', Permission::class);
      Route::patch('/{permission}/update', [PermissionCRUDController::class, 'update'])->middleware([EnsurePermissionExists::class, EnsurePermissionIsNotLocked::class])->name('update')->can('update', Permission::class);
      Route::delete('/{permission}/destroy', [PermissionCRUDController::class, 'destroy'])->name('destroy')->can('delete', Permission::class);
    });
  });
});
