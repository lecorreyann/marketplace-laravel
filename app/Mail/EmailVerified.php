<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class EmailVerified extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   */
  public function __construct(public User $user)
  {
    //
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      subject: 'Email verified',
      to: $this->user->email
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {
    return new Content(
      view: 'emails.email_verified',
      text: 'emails.email_verified-text',
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
