<?php

namespace App\Listeners;

use App\Events\TicketCreated;
use App\Mail\TicketGenerateMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendTicketVerificationMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TicketCreated  $event
     * @return void
     */
    public function handle(TicketCreated $event)
    {
        // $mailSentTo = explode(',', auth()->user()->email . "," . config('ticket.admin_email'));
        Mail::to(config('ticket.admin_email'))->send(
            new TicketGenerateMail($event->ticket)
        );
    }
}
