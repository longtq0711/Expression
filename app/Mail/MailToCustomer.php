<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailToUser extends Mailable
{
    use Queueable, SerializesModels;

    protected $detail;
    protected $user;

    /**
     * Create a new message instance.
     *
      * @return void
     */
    
    public function __construct($detail, $user)
    {
        $this->detail = $detail;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $detail = $this->detail;
        return $this->from($this->user->email_group, $this->user->name)->subject($this->detail['title'])->view('mails.editMail', compact('detail'));
    }
}
