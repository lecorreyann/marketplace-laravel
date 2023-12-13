<?php

use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Middleware\EnsureVerificationEmailTokenIsValid;
use App\Http\Middleware\EnsurePasswordResetTokenIsValid;
use Illuminate\Support\Facades\Route;

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




Route::name('auth.')->group(function () {
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
