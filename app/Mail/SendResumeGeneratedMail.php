<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendResumeGeneratedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $uuid = null;
    public $name = null;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($uuid, $name)
    {
        $this->uuid = $uuid;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.test')
            ->subject('Resume generated successfully.')
            ->from("oneforyllix@gmail.com", "Budash");
    }
}
