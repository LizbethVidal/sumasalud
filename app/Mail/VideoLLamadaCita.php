<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VideoLLamadaCita extends Mailable
{
    use Queueable, SerializesModels;

    protected $cita;
    protected $asunto;

    /**
     * Create a new message instance.
     */
    public function __construct($cita, $asunto)
    {
        $this->cita = $cita;
        $this->asunto = $asunto;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('centromedico@sumasalud.online', 'Suma Salud'),
            subject: $this->asunto,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.citas.videollamada',
            with: ['cita' => $this->cita]
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

    public function build()
    {
        return $this->markdown('mails.citas.videollamada', ['cita' => $this->cita]);
    }
}
