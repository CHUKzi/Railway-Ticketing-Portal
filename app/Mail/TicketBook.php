<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketBook extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $MailData;
    public function __construct($MailData)
    {
        $this->MailData = $MailData;
    }
    /**
     * Get the message envelope.
     */
    /*     public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ticket Book',
        );
    }
 */
    /**
     * Get the message content definition.
     */
    /*     public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }
 */
    public function build()
    {
        return $this->subject('Your Ticket Booked Confirmation ')
            ->view('emails.tickets-booking');
    }
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    /*     public function attachments(): array
    {
        return [];
    } */
}
