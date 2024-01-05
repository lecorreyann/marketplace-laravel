<?php

// Path: routes/auth.php
use Illuminate\Support\Facades\Route;

// Middlewares
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\EnsureVerificationEmailTokenIsValid;
use App\Http\Middleware\EnsurePasswordResetTokenIsValid;

// Controllers
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\SignIn;
use App\Livewire\Auth\SignUp;
use App\Livewire\Auth\VerifyEmail;
use App\Http\Controllers\Auth\SignOutController;


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
    Route::get('/sign-up', SignUp::class)->name('sign_up.index');
    // sign in
    Route::get('/sign-in', SignIn::class)->name('sign_in.index');
    Route::post('/sign-in',  SignIn::class)->name('sign_in.store');
    // verify email
    Route::get('/verify-email', VerifyEmail::class)->middleware(EnsureVerificationEmailTokenIsValid::class)->name('verify_email.index');
    Route::post('/verify-email', VerifyEmail::class)->name('verify_email.store');
    // forgot password
    Route::get('/forgot-password', ForgotPassword::class)->name('forgot_password.index');
    Route::post('/forgot-password', ForgotPassword::class)->name('forgot_password.store');
    // reset password
    Route::get('/reset-password', ResetPassword::class)->middleware(EnsurePasswordResetTokenIsValid::class)->name('reset_password.index');
    Route::patch('/reset-password', ResetPassword::class)->middleware(EnsurePasswordResetTokenIsValid::class)->name('reset_password.update');
  });

  // authenticated routes
  // sign out
  Route::delete('/sign-out', [SignOutController::class, 'delete'])->name('sign_out.delete');
});
