<?php

namespace App\Listeners;

use App\Events\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PasswordReset as PasswordResetNotification;

class SendPasswordResetNotification
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
  public function handle(PasswordReset $event): void
  {
    //
    Notification::send($event->user, new PasswordResetNotification);
  }
}
