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

    public $subject = (SITE === 'china' ? '支付成功' : 'Payment Received');
    /**
     * @param $order array
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
