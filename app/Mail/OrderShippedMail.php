<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShippedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Shipment Initiated';

    public $order;
    /**
     * Create a new message instance.
     * @param $order array
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
        return $this->view('mail.global.order.shipped');
    }
}
