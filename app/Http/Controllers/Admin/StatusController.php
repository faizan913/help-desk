<?php

namespace App\Http\Controllers\Admin;

use Log;
use Throwable;
use App\Models\Status;
use Illuminate\View\View;
use App\Http\Traits\QueryTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\StatusRequest;
use App\Repositories\StatusRepositoryInterface;

class StatusController extends Controller
{
    use QueryTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $repository;

    public function __construct(StatusRepositoryInterface $repository)
    {
        $this->repository = $repository;
        // $this->service = $service;
    }


    /**
     * Show index.
     *
     * @return Illuminate\View\View
     */
    public function index(): View
    {
        try {
            $statuses = $this->repository->all();
            return view('admin.status.index', compact('statuses'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.no_record'));
        }
    }

    /**
     * Create Status.
     *
     * @return Illuminate\View\View
     */

    public function create(): View
    {
        try {
            return view('admin.status.create');
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.no_record'));
        }
    }

    /**
     * Store Model.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function store(StatusRequest $request)
    {
        try {
            $this->repository->storeStatus($request->all());
            return redirect()->route('statuses.index')->with('success',  trans('message.record_saved'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.no_record'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Status  $status
     * @return Illuminate\View\View
     */
    public function edit(Status $status): View
    {
        try {
            return view('admin.status.edit', compact('status'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }

    /**
     * Update specified resource.
     *
     * @param  \App\Status  $status
     * @param  \App\StatusRequest  $request
     * 
     */
    public function update(StatusRequest $request, Status $status)
    {
        try {
            $data = request()->except(['_token', '_method']);
            $this->repository->updateStatus($status->id, $data);
            return redirect()->route('statuses.index')->with('success',  trans('message.record_updated'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }

    /**
     * Delete Status by model id.
     *
     * @return bool
     */
    public function destroy($id)
    {
        try {
            if (count($this->getStatusCountBelongstoTickets($id)) > 0) {
                return back()->with('assigned_to_ticket',  trans('message.not_deleted'));
            } else {
                $this->repository->deleteById($id);
                return back()->with('delete',  trans('message.record_deleted'));
            }
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }
}
