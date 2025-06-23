<?php

namespace App\Mail;

use App\Models\ScholarshipApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ScholarshipApplicationStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $user;
    public $temporaryPassword;

    /**
     * Create a new message instance.
     */
    public function __construct(ScholarshipApplication $application, $user = null, $temporaryPassword = null)
    {
        $this->application = $application;
        $this->user = $user;
        $this->temporaryPassword = $temporaryPassword;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $statusText = ucfirst($this->application->status);
        return new Envelope(
            subject: "Scholarship Application {$statusText} - Hauz Hayag Foundation",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.scholarship-application-status-update',
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
