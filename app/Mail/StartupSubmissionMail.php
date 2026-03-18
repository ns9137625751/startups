<?php

namespace App\Mail;

use App\Models\StartupProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StartupSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public StartupProfile $profile) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Startup Profile Submitted – ' . $this->profile->company_name);
    }

    public function content(): Content
    {
        return new Content(markdown: 'emails.startup-submission', with: ['profile' => $this->profile]);
    }
}
