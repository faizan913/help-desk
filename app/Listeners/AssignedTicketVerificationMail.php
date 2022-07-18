<?php

namespace App\Listeners;

use App\Events\AssignedTicket;
use App\Mail\AssignedTicketMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssignedTicketVerificationMail
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
     * @param  \App\Events\AssignedTicket  $event
     * @return void
     */
    public function handle(AssignedTicket $event)
    {
        Mail::to($event->assigned_to)->send(
            new AssignedTicketMail($event->ticket, $event->assigned_to)
        );
    }
}
