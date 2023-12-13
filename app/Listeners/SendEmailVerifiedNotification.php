<?php

namespace App\Listeners;

use App\Events\AccountCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\EmailVerified as EmailVerifiedNotification;

class SendEmailVerifiedNotification
{
  /**
   * Create the event listener.
   */
  public function __construct()
  {
    //
  }

  /**
   * Handle the event.
   */
  public function handle(AccountCreated $event): void
  {
    //
    Notification::send($event->user, new EmailVerifiedNotification);
  }
}
