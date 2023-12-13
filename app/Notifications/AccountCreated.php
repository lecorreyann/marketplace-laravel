<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;
use App\Mail\AccountCreated as AccountCreatedMail;

class AccountCreated extends Notification
{
  use Queueable;

  /**
   * Create a new notification instance.
   */
  public function __construct()
  {
    //
  }

  /**
   * Get the notification's delivery channels.
   *
   * @return array<int, string>
   */
  public function via(object $notifiable): array
  {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   */
  public function toMail(object $notifiable): Mailable
  {
    return (new AccountCreatedMail($notifiable));
  }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toArray(object $notifiable): array
  {
    return [
      //
    ];
  }
}
