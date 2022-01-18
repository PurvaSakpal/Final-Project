<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data=$this->data;
        return $this->from('example@example.com', 'Example')
        ->view('Mail.OrderConfirmationMail')->with([
            'name' => $data['firstname']." ".$data['lastname'],

            'email' => $data['email'],
            'address' => $data['address1'],
            'pcode' => $data['pcode'],
            'mobile' => $data['mobile'],
            'cart_sub_total' => $data['cart_sub_total'],
            'shipping_cost' => $data['shipping_cost'],
            'total' => $data['total']
        ]);
    }
}
