<?php

namespace App\Providers;

use App\Providers\TicketCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTicketVerificationMail
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
     * @param  \App\Providers\TicketCreated  $event
     * @return void
     */
    public function handle(TicketCreated $event)
    {
        //
    }
}
