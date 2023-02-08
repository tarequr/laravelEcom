<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderMail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderMail)
    {
        $this->orderMail = $orderMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Invoice From NextGen')->view('frontend.mail.invoice');
    }
}
