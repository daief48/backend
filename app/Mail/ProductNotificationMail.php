<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProductNotificationMail extends Mailable
{
    public function __construct(
        public Product $product,
        public string $action
    ) {}

    public function build()
    {
        return $this->subject("Product {$this->action}")
            ->view('emails.product');
    }
}

