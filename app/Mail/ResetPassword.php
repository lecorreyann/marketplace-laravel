<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ResetPassword extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   */
  public function __construct(public User $user, public string $password_reset_token)
  {
    //
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      subject: 'Reset Password',
      to: $this->user->email
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {
    return new Content(
      view: 'emails.reset_password',
      text: 'emails.reset_password-text',
    );
  }

  /**
   * Get the attachments for the message.
   *
   * @return array<int, \Illuminate\Mail\Mailables\Attachment>
   */
  public function attachments(): array
  {
    return [];
  }
}
