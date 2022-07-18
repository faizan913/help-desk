<?php

namespace App\Http\Controllers\Admin;

use Log;
use Throwable;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\View\View;
use App\Events\TicketCreated;
use Illuminate\Http\Response;
use App\Events\AssignedTicket;
use App\Http\Traits\QueryTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Services\Admin\TicketService;
use App\Http\Requests\MergeTicketRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Repositories\TicketRepositoryInterface;

class TicketController extends Controller
{
    use QueryTrait;
    /**
     * Create constructor.
     *
     * @return void
     */
    private $repository;
    private $service;

    public function __construct(TicketRepositoryInterface $repository, TicketService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }


    /**
     * Show the application ticket.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        try {
            if (auth()->user()->hasRole('Admin')) {
                $tickets = $this->repository->all(['status', 'priority', 'service', 'assigned_to_user']);
            } else {
                $tickets = $this->service->allTickets();
            }
            return view('admin.ticket.index', compact('tickets'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.no_record'));
        }
    }

    /**
     * Store Ticket.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $this->authorize('create', Ticket::class);
        try {

            $data['services'] = $this->getService();
            $data['statuses'] = $this->getStatus();
            $data['priorities'] = $this->getPriority();
            $data['departments'] = $this->getDepartment();
            $data['assigned_to_users'] = $this->getAllUserBelongsToTST();
            return view('admin.ticket.create', compact('data'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.no_record'));
        }
    }

    /**
     * Store Ticket.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(TicketRequest $request)
    {
        $this->authorize('create', Ticket::class);
        try {
            $ticket = $this->service->saveTicket($request);
            if ($request->assigned_to_user_id != null) {
                $user = User::find($request->assigned_to_user_id);
                AssignedTicket::dispatch($ticket, $user->email);
            }
            TicketCreated::dispatch($ticket);
            return redirect()->route('tickets.index')->with('success',  trans('message.record_saved'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }

    /**
     * Show Ticket.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Ticket $ticket)
    {

        try {
            if (auth()->user()->hasRole('Admin')) {
                $ticket = $this->service->show(['status', 'priority', 'service', 'assigned_to_user', 'comments'], $ticket->id);
            } else {
                $ticket = $this->repository->findTicketByLoggedInUser(['status', 'priority', 'service', 'assigned_to_user', 'comments'], $ticket->id);
            }
            if (!$ticket) {
                abort(403, Response::HTTP_FORBIDDEN);
            }
            return view('admin.ticket.show', compact('ticket'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            if ($e->getStatusCode() == 403)
                abort(403, 'This is not your ticket');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Model
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        try {
            $data['statuses'] = $this->getStatus();
            $data['priorities'] = $this->getPriority();
            $data['services'] = $this->getService();
            $data['assigned_to_users'] = $this->getAllUserBelongsToTST();

            if (auth()->user()->hasRole('Admin')) {
                $data['ticket'] = $this->service->show(['status', 'priority', 'service', 'assigned_to_user', 'comments'], $ticket->id);
            } else {
                $data['ticket'] = $this->repository->findTicketByLoggedInUser(['status', 'priority', 'service', 'assigned_to_user', 'comments'], $ticket->id);
            }
            if (!$data['ticket']) {
                abort(403, Response::HTTP_FORBIDDEN);
            }
            return view('admin.ticket.edit', compact('data'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            if ($e->getStatusCode() == 403)
                abort(403, 'This is not your ticket');
        }
    }

    /**
     * Update model.
     *
     * @return bool
     */
    public function update(TicketRequest $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        try {
            $ticket = $this->service->updateTicket($request);
            if ($request->assigned_to_user_id != null) {
                $user = User::find($request->assigned_to_user_id);
                AssignedTicket::dispatch($ticket, $user->email);
            }
            return redirect()->route('tickets.index')->with('success',  trans('message.record_updated'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }

    /**
     * Delete Ticket by model id.
     *
     * @return bool
     */
    public function destroy($id)
    {
        $this->authorize('delete', Ticket::class);

        try {
            $this->repository->deleteById($id);
            return back()->with('delete',  trans('message.record_deleted'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }

    /**
     * post ticket comment.
     *
     * @return bool
     */
    public function storeComment(StoreCommentRequest $request, Ticket $ticket)
    {
        try {
            $ticket = $this->service->storeComment($request, $ticket);
            return back()->with('comment',  trans('message.comment_saved'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }


    public function ticketMerge($id, Ticket $ticket)
    {
        $this->authorize('merge', $ticket);
        try {
            if (auth()->user()->hasRole('Admin')) {
                $ticket = $this->service->show(['status', 'priority', 'service', 'assigned_to_user', 'comments'], $id);
            }
            if (!$ticket) {
                abort(403, Response::HTTP_FORBIDDEN);
            }
            return view('admin.ticket.merge', compact('ticket'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            if ($e->getStatusCode() == 403)
                abort(403, 'This is not your ticket');
        }
    }

    /**
     * Merge Tickets.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function merge(MergeTicketRequest $request, Ticket $ticket)
    {
        $this->authorize('merge', $ticket);
        try {
            $ticket = $this->service->mergeTicket($request);
            if ($ticket != 'merged') {
                return back()->with('choose_another', $ticket);
            }
            return redirect()->route('tickets.index')->with('merged',  trans('message.ticket_merged'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }
}
