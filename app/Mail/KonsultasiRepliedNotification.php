<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KonsultasiRepliedNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $userName;
    public $konsultasiUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($userName, $konsultasiUrl)
    {
        $this->userName = $userName;
        $this->konsultasiUrl = $konsultasiUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Balasan Konsultasi Baru - Taaruf Al-Azhar',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.konsultasi.replied',
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
