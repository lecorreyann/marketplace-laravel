<?php

namespace App\Listeners;

use App\Events\RequestResetPasswordLink;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\VerifyEmail as VerifyEmailNotification;

class SendResetPasswordNotification
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
  public function handle(RequestResetPasswordLink $event): void
  {
    //
    Notification::send($event->user, new ResetPasswordNotification);
  }
}
