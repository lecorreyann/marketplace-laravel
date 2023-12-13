<?php

namespace App\Listeners;

use App\Events\AccountCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AccountCreated as AccountCreatedNotification;

class SendAccountCreatedNotification
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
    Notification::send($event->user, new AccountCreatedNotification);
  }
}
