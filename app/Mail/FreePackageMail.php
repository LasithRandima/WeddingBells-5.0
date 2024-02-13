<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FreePackageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vendorName;
    public $packageName;
    public $imageCount;
    public $adsCount;
    public $topAdsCount;
    public $boughtDate;
    public $expirationDate;

    /**
     * Create a new message instance.
     */
    public function __construct($vendorName, $packageName, $imageCount, $adsCount, $topAdsCount, $boughtDate, $expirationDate)
    {
        $this->vendorName = $vendorName;
        $this->packageName = $packageName;
        $this->imageCount = $imageCount;
        $this->adsCount = $adsCount;
        $this->topAdsCount = $topAdsCount;
        $this->boughtDate = $boughtDate;
        $this->expirationDate = $expirationDate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Free Package Get Started - WeddingBells',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'view.name',
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
