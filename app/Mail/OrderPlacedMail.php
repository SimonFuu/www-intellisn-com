<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    /**
     *
     *
     * @return void
     */
    public function __construct($order = [])
    {
        $this -> order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.global.order.placed');
    }
}
