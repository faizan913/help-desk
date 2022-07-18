<?php

namespace App\Http\Controllers\Admin;

use Log;
use Throwable;
use Illuminate\View\View;
use App\Http\Traits\QueryTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\PriorityRequest;
use App\Models\Priority;
use App\Repositories\PriorityRepositoryInterface;

class PriorityController extends Controller
{
    use QueryTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $repository;

    public function __construct(PriorityRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        try {
            $priorities = $this->repository->all();
            return view('admin.priority.index', compact('priorities'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.no_record'));
        }
    }

    /**
     * Store model.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function create(): View
    {
        try {
            return view('admin.priority.create');
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

    public function store(PriorityRequest $request)
    {
        try {
            $this->repository->storeRepository($request->all());
            return redirect()->route('priorities.index')->with('success',  trans('message.record_saved'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.no_record'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Priority  $riority
     * @return \Illuminate\Http\Response
     */
    public function edit(Priority $priority)
    {
        try {
            return view('admin.priority.edit', compact('priority'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }

    public function update(PriorityRequest $request, Priority $priority)
    {
        try {
            $data = request()->except(['_token', '_method']);
            $this->repository->updateRepository($priority->id, $data);
            return redirect()->route('priorities.index')->with('success',  trans('message.record_updated'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }

    /**
     * Delete Priority by model id.
     *
     * @return bool
     */
    public function destroy($id)
    {
        try {
            if (count($this->getPriorityCountBelongstoTickets($id)) > 0) {
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
