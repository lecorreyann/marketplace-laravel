<?php

namespace App\Providers;

use App\Events\AccountCreated;
use App\Events\EmailVerified;
use App\Events\PasswordReset;
use App\Events\RequestResetPasswordLink;
use App\Events\RequestVerifyEmailLink;
use App\Listeners\SendAccountCreatedNotification;
use App\Listeners\SendVerifyEmailNotification;
use App\Listeners\SendEmailVerifiedNotification;
use App\Listeners\SendResetPasswordNotification;
use App\Listeners\SendPasswordResetNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
  /**
   * The event to listener mappings for the application.
   *
   * @var array<class-string, array<int, class-string>>
   */
  protected $listen = [
    AccountCreated::class => [
      SendAccountCreatedNotification::class,
      SendVerifyEmailNotification::class,
    ],
    RequestVerifyEmailLink::class => [
      SendVerifyEmailNotification::class,
    ],
    EmailVerified::class => [
      SendEmailVerifiedNotification::class,
    ],
    RequestResetPasswordLink::class => [
      SendResetPasswordNotification::class,
    ],
    PasswordReset::class => [
      SendPasswordResetNotification::class,
    ],
  ];

  /**
   * Register any events for your application.
   */
  public function boot(): void
  {
    //
  }

  /**
   * Determine if events and listeners should be automatically discovered.
   */
  public function shouldDiscoverEvents(): bool
  {
    return false;
  }
}
