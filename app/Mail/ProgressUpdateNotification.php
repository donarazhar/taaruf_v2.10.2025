<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProgressUpdateNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $statusUpdate;
    public $messageText;
    public $progressUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($statusUpdate, $messageText, $progressUrl)
    {
        $this->statusUpdate = $statusUpdate;
        $this->messageText = $messageText;
        $this->progressUrl = $progressUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pembaruan Status Taaruf Anda (' . $this->statusUpdate . ')',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.progress.update',
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
