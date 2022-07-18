<?php

namespace App\Http\Controllers\Admin;

use Log;
use Throwable;
use App\Models\Service;
use Illuminate\View\View;
use App\Http\Traits\QueryTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Repositories\ServiceRepositoryInterface;

class ServiceController extends Controller
{
    use QueryTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $repository;

    public function __construct(ServiceRepositoryInterface $repository)
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
            $services = $this->repository->all();
            return view('admin.service.index', compact('services'));
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
        try {
            return view('admin.service.create');
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

    public function store(ServiceRequest $request)
    {
        try {
            $this->repository->storeService($request->all());
            return redirect()->route('services.index')->with('success',  trans('message.record_saved'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.no_record'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service): View
    {
        try {
            return view('admin.service.edit', compact('service'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }


    public function update(ServiceRequest $request, Service $service)
    {
        try {
            $data = request()->except(['_token', '_method']);
            $this->repository->updateService($service->id, $data);
            return redirect()->route('services.index')->with('success',  trans('message.record_updated'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }

    /**
     * Delete Service by model id.
     *
     * @return bool
     */
    public function destroy($id)
    {
        try {
            if (count($this->getServiceCountBelongstoTickets($id)) > 0) {
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
