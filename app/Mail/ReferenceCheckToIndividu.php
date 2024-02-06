<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReferenceCheckToIndividu extends Mailable
{
    use Queueable, SerializesModels;
    public $data_email_reference_check;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_email_reference_check)
    {
        $this->data_email_reference_check = $data_email_reference_check ;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Reference Check '.$this->data_email_reference_check ['nama_pelamar'] ,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.view-reference-check-email-to-individu',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
