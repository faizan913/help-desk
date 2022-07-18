<?php

namespace App\Http\Controllers\FrontEnd;

use Log;
use Throwable;
use App\Models\User;
use App\Models\Rating;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Events\TicketCreated;
use Illuminate\Http\Response;
use App\Http\Traits\QueryTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Services\Front\TicketService;
use App\Notifications\NotifyTicketOwner;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Support\Facades\Notification;
use App\Repositories\TicketRepositoryInterface;

class TicketController extends Controller
{
    use QueryTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $service;

    public function __construct(TicketService $service)
    {
        $this->service = $service;
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        try {
            $tickets = $this->service->allTickets();
            return view('frontend.list', compact('tickets'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.no_record'));
        }
    }

    /**
     * Show the Open tickets.
     *
     * @return \Illuminate\View\View
     */
    public function openTickets(): View
    {
        try {
            $tickets =  $this->service->openTickets();
            return view('frontend.list', compact('tickets'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.no_record'));
        }
    }

    /**
     * Show the Open tickets.
     *
     * @return \Illuminate\View\View
     */
    public function closeTickets(): View
    {
        try {
            $tickets =  $this->service->closeTickets();
            return view('frontend.list', compact('tickets'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.no_record'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function show($id): View
    {
        try {
            $ticket =  $this->service->findTicketBelongsToUser($id);
            $ratings = $this->service->foundRating($id);

            if (!$ticket) {
                abort(403, Response::HTTP_FORBIDDEN);
            }
            return view('frontend.show', compact('ticket', 'ratings'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            if ($e->getStatusCode() == 403)
                abort(403, 'This is not your ticket');
        }
    }

    /**
     * Store Ticket.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        try {
            $data['services'] = $this->getService();
            $data['priorities'] = $this->getPriority();

            return view('frontend.create', compact('data'));
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
        try {
            $ticket =  $this->service->store($request);
            $user = User::find(auth()->user()->id);
            TicketCreated::dispatch($ticket);
            Notification::send($user, new NotifyTicketOwner($ticket));
            return redirect()->route('ticket.list')->with('success',  trans('message.user_data_sent'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }

    /**
     * Show Home page.
     *
     * @return \Illuminate\View\View
     */
    public function home(): View
    {
        return view('frontend.home');
    }

    /**
     * Store Rating.
     *
     * @return bool
     */
    public function storeRating(Request $request)
    {
        try {
            $this->service->storeRating($request);
            return response()->json(['rating' => trans('message.rating_added')]);
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }

    /**
     * Store Reply Rating.
     *
     * @return bool
     */
    public function storeCommentRating(Request $request)
    {
        try {
            $this->service->storeReplyRating($request);
            return response()->json(['rating' => trans('message.rating_added')]);
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
    public function storeComment(StoreCommentRequest $request)
    {
        try {
            $this->service->storeComment($request);
            return back()->with('comment',  trans('message.comment_saved'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }
}
