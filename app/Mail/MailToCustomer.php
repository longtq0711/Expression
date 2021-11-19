<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailToCustomer extends Mailable
{
    use Queueable, SerializesModels;

    protected $orders;

    /**
     * Create a new message instance.
     *
      * @return void
     */
    
    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $orders = $this->orders;
        return $this->from('qlonga2k44@gmail.com')->subject('Complete order')->view('mails.mail-notify', compact('orders'));
    }
}
