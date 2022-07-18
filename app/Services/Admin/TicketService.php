<?php

namespace App\Services\Admin;

use App\Models\Status;
use App\Models\Ticket;
use App\Repositories\Eloquent\TicketRepository;
use App\Repositories\TicketRepositoryInterface;

class TicketService
{
    /**
     * The Configuration repository instance.
     *
     * @var TicketRepository
     */

    private $repository;

    public function __construct(TicketRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public  function show($collections = [], $id)
    {
        return $this->repository->find($collections, $id);
    }


    public function saveTicket($request)
    {
        $ticket = Ticket::where('title', 'like', '%' . $request->title . '%');
        if ($ticket->exists()) {
            abort(403, 'Same records exist');
        }
        $status = $request->status ?? Status::STATUS['OPEN'];
        $assigned_to = $request->assigned_to_user_id ?? null;
        $tickets = [
            'title' => $request->title,
            'system_name' => $request->system_name,
            'content' => $request->content,
            'status_id' => $status,
            'service_id' => $request->service,
            'priority_id' => $request->priority,
            'assigned_to_user_id' => $assigned_to,
            'created_by' => auth()->id(),
        ];

        $ticket = $this->repository->create($tickets);
        if ($request->hasFile('attachment')) {
            $ticket->addMedia($request->file('attachment'))->toMediaCollection(Ticket::TICKET_IMG);
        }

        return $ticket;
    }

    public function updateTicket($request)
    {
        $ticket = Ticket::find($request->ticket_id);
        $status = $request->status ?? Status::STATUS['OPEN'];
        $assigned_to = $request->assigned_to_user_id ?? $ticket->assigned_to_user_id;
        $tickets = [
            'title' => $request->title,
            'system_name' => $request->system_name,
            'content' => $request->content,
            'status_id' => $status,
            'service_id' => $request->service,
            'priority_id' => $request->priority,
            'assigned_to_user_id' => $assigned_to,
        ];
        if (!empty($request->ticket_id)) {

            $this->repository->ticketUpdate($request->ticket_id, $tickets);
            if ($request->hasFile('attachment')) {
                $ticket->clearMediaCollection(Ticket::TICKET_IMG);
                $ticket->addMedia($request->file('attachment'))->toMediaCollection(Ticket::TICKET_IMG);
            }
            //Check if status closed then notify to ticket raiser with mail

            return $ticket;
        }
    }

    public function storeComment($request, $ticket)
    {
        $user = auth()->user();
        $comment = $ticket->comments()->create([
            'user_id'       => $user->id,
            'comment'  => $request->comment
        ]);
        return $comment;
    }

    public function mergeTicket($request)
    {
        $data = Ticket::find($request->ticket_id);

        if (!$data) {

            return trans('message.not_found');
        } else {
            if ($request->ticket_id == $request->cuur_ticket_id) {

                return trans('message.choose_another');
            } else {

                if (Ticket::where('id', $request->ticket_id)->pluck('created_by') == Ticket::where('id', $request->cuur_ticket_id)->pluck('created_by')) {
                    //compare both ticket title, category
                    $ticket1 = Ticket::where('id', $request->ticket_id)->pluck('title', 'service_id');
                    $ticket2 = Ticket::where('id', $request->cuur_ticket_id)->pluck('title', 'service_id');
                    if ($ticket1 == $ticket2) {
                        $merged = Ticket::select('*')
                            ->groupBy('title')
                            ->get();
                        dd($merged);
                        //$merged =  Ticket::where('id', $request->ticket_id)->delete();
                        if ($merged) {
                            return trans('message.merged');
                        }
                    } else {

                        return  trans('message.not_merge');
                    }
                } else {

                    return  trans('message.ticket_belongs_to_diffrent_user');
                }
            }
        }
    }

    public function allTickets()
    {
        return auth()->user()->tickets()->get();
    }
}



/* 
NOtify Functio on closed ticket
dd($ticket->user->id);
if (Status::whereId($request->status)->pluck('name')[0] == Status::STATUS_CLOSED) {
    ClosedTicket::dispatch($ticket->user->id);
    $user = User::find($ticket->user->id);
    Notification::send($user, new ClosedTicket($ticket));
} */
