<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\ConfirmUserEmail;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerificationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
		$hash=base64_encode($event->user);
		Mail::to('Sanya.Chuck@mail.ru')->send(new ConfirmUserEmail($hash));
    }
}
