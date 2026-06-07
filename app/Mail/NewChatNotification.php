<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewChatNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $senderName;
    public $messageExcerpt;
    public $chatUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($senderName, $messageExcerpt, $chatUrl)
    {
        $this->senderName = $senderName;
        $this->messageExcerpt = $messageExcerpt;
        $this->chatUrl = $chatUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pesan Baru dari ' . $this->senderName . ' - Taaruf Al-Azhar',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.chat.new',
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
