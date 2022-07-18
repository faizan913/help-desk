<?php

namespace App\Services\Front;

use App\Models\Rating;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\Comment;
use App\Repositories\Eloquent\TicketRepository;

class TicketService
{


    /**
     * The Configuration repository instance.
     *
     * @var TicketRepository
     */

    private $repository;

    public function __construct(TicketRepository $repository)
    {
        $this->repository = $repository;
    }

    public function allTickets()
    {
        return auth()->user()->ticketCreators()->get();
    }

    public function closeTickets()
    {
        return Ticket::whereHas(
            'status',
            function ($query) {
                $query->whereName('Closed');
            }
        )->where('created_by', auth()->id())->get();
    }

    public function openTickets()
    {
        return Ticket::whereHas(
            'status',
            function ($query) {
                $query->whereName('Open');
            }
        )->where('created_by', auth()->id())->get();
    }
    public function store($request)
    {
        $ticket = [
            'title' => $request->title,
            'author_name' => $request->author_name,
            'author_email' => $request->author_email,
            'system_name' => $request->system_name,
            'content' => $request->content,
            'status_id' => Status::STATUS['OPEN'],
            'service_id' => $request->service,
            'priority_id' => $request->priority,
            'created_by' => auth()->id(),
        ];
        $ticket = $this->repository->create($ticket);
        if ($request->hasFile('attachment')) {
            $ticket->addMedia($request->file('attachment'))->toMediaCollection(Ticket::TICKET_IMG);
        }
        return $ticket;
    }

    public function storeRating($request)
    {
        $matchThese = ['user_id' => $request->user_id, 'ticket_id' => $request->ticket_id,];
        return  Rating::updateOrCreate($matchThese, ['rating' => $request->rate, 'status' => Rating::STATUS_INACTIVE,]);
    }

    public function storeReplyRating($request)
    {
        $comment = Comment::find($request->comment_id);
        $comment->rating = $request->rating;
        $comment->status = Comment::STATUS_INACTIVE;
        $comment->save();
        return $comment;
    }

    public function findTicketBelongsToUser($id)
    {
        return auth()->user()->ticketCreators()->find($id);
    }

    public function storeComment($request)
    {
        $user = auth()->user();
        $comment = Comment::create([
            'ticket_id'     => $request->id,
            'user_id'       => $user->id,
            'comment'  => $request->comment
        ]);
        return $comment;
    }

    public function foundRating($id)
    {
        return Rating::where('user_id', auth()->id())
            ->where('ticket_id', $id)
            ->first();
    }
}
