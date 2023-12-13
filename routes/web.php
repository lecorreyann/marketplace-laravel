<?php

// Path: routes/web.php

// Auth Controllers
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignOutController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Category Controllers
use App\Http\Controllers\Category\CRUDController as CategoryCRUDController;

use App\Http\Middleware\EnsureVerificationEmailTokenIsValid;
use App\Http\Middleware\EnsurePasswordResetTokenIsValid;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\Category;

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

Route::get('/', function () {
  return view('home');
})->name('home');



/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register auth routes for your application.
|
*/
Route::name('auth.')->group(function () {

  // unauthenticated routes
  Route::middleware(RedirectIfAuthenticated::class)->group(function () {
    // sign up
    Route::get('/sign-up', [SignUpController::class, 'index'])->name('sign_up.index');
    Route::post('/sign-up', [SignUpController::class, 'store'])->name('sign_up.store');
    // sign in
    Route::get('/sign-in', [SignInController::class, 'index'])->name('sign_in.index');
    Route::post('/sign-in', [SignInController::class, 'store'])->name('sign_in.store');
    // verify email
    Route::get('/verify-email', [VerifyEmailController::class, 'index'])->middleware(EnsureVerificationEmailTokenIsValid::class)->name('verify_email.index');
    Route::post('/verify-email', [VerifyEmailController::class, 'store'])->name('verify_email.store');
    Route::post('/request-verify-email-link', [VerifyEmailController::class, 'store'])->name('verify_email.store');
    // forgot password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot_password.index');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('forgot_password.store');
    // reset password
    Route::get('/reset-password', [ResetPasswordController::class, 'index'])->middleware(EnsurePasswordResetTokenIsValid::class)->name('reset_password.index');
    Route::patch('/reset-password', [ResetPasswordController::class, 'update'])->middleware(EnsurePasswordResetTokenIsValid::class)->name('reset_password.update');
  });

  // authenticated routes
  // sign out
  Route::delete('/sign-out', [SignOutController::class, 'delete'])->name('sign_out.delete');
});


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
  // Category Routes (CRUD)
  Route::middleware([])->group(function () {
    Route::get('/categories', [CategoryCRUDController::class, 'index'])->name('categories.index');
    Route::name('category.')->prefix('/category')->group(function () {
      Route::get('/create', [CategoryCRUDController::class, 'create'])->name('create')->can('create', Category::class);
      Route::post('/store', [CategoryCRUDController::class, 'store'])->name('store');
      Route::get('/{category}/edit', [CategoryCRUDController::class, 'edit'])->name('edit');
      Route::patch('/{category}/update', [CategoryCRUDController::class, 'update'])->name('update');
      Route::delete('/{category}/destroy', [CategoryCRUDController::class, 'destroy'])->name('destroy');
    });
  });
});
