<?php

namespace App\Http\View\Composers;

use App\Models\Ticket;
use Illuminate\View\View;

class TicketComposer
{


    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $data['totalTickets'] = Ticket::where('created_by', auth()->id())->count();
        $data['openTickets'] = Ticket::whereHas(
            'status',
            function ($query) {
                $query->whereName('Open');
            }
        )->where('created_by', auth()->id())->count();
        $data['closedTickets'] = Ticket::whereHas('status', function ($query) {
            $query->whereName('Closed');
        })->where('created_by', auth()->id())
            ->count();

        $view->with('counts', $data);
    }
}
