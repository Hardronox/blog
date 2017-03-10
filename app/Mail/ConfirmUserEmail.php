<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmUserEmail extends Mailable
{
    use Queueable, SerializesModels;

	public $hash;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($hash)
    {
        $this->hash=$hash;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.confirm-email',['hash'=>$this->hash]);
    }
}
