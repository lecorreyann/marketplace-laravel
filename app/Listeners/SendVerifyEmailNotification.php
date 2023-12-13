<?php

namespace App\Listeners;

use App\Events\AccountCreated;
use App\Events\RequestVerifyEmailLink;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\VerifyEmail as VerifyEmailNotification;

class SendVerifyEmailNotification
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
  public function handle(AccountCreated|RequestVerifyEmailLink $event): void
  {
    //
    Notification::send($event->user, new VerifyEmailNotification);
  }
}
