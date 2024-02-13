<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RsvpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rsvplink;
    public $inviteMsg;
    public $client_name;
    public $partner_name;
    public $wedding_date;
    public $wedding_start_time;

    // Mail::to($email)->send(new RsvpMail($rsvplink, $inviteMsg));
    /**
     * Create a new message instance.
     */
    public function __construct($rsvplink, $inviteMsg, $client_name, $partner_name, $wedding_date, $wedding_start_time)
    {
        $this->rsvplink = $rsvplink;
        $this->inviteMsg = $inviteMsg;
        $this->client_name = $client_name;
        $this->partner_name = $partner_name;
        $this->wedding_date = $wedding_date;
        $this->wedding_start_time = $wedding_start_time;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirm Your Attandance - '.$this->client_name.' & '.$this->partner_name. ' Wedding',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'common.weddingInvitationMail',
            with:[
                'rsvplink' => $this->rsvplink,
                'inviteMsg' => $this->inviteMsg,
                'client_name' => $this->client_name,
                'partner_name' => $this->partner_name,
                'wedding_date' => $this->wedding_date,
                'wedding_start_time' => $this->wedding_start_time,

            ]
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
