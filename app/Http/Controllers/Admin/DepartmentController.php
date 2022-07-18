<?php

namespace App\Http\Controllers\Admin;

use Log;
use Throwable;
use Illuminate\View\View;
use App\Models\Department;
use App\Http\Traits\QueryTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Services\Admin\DepartmentService;
use App\Repositories\DepartmentRepositoryInterface;

class DepartmentController  extends Controller
{
    use QueryTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $repository;
    private $service;
    public function __construct(DepartmentRepositoryInterface $repository, DepartmentService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }


    /**
     * Show index.
     *
     * @return Illuminate\View\View
     */
    public function index(): View
    {
        try {
            $departments = $this->repository->all();
            return view('admin.department.index', compact('departments'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.no_record'));
        }
    }

    /**
     * Create department.
     *
     * @return Illuminate\View\View
     */

    public function create(): View
    {
        try {
            return view('admin.department.create');
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

    public function store(DepartmentRequest $request)
    {
        try {
            $this->service->create($request->all());
            return redirect()->route('departments.index')->with('success',  trans('message.record_saved'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.no_record'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return Illuminate\View\View
     */
    public function edit(Department $department): View
    {
        try {
            return view('admin.department.edit', compact('department'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }

    /**
     * Update specified resource.
     *
     * @param  \App\Department  $department
     * @param  \App\DepartmentRequest  $request
     * 
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        try {
            $data = request()->except(['_token', '_method']);
            $this->repository->updateDepartment($department->id, $data);
            return redirect()->route('departments.index')->with('success',  trans('message.record_updated'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }

    /**
     * Delete by model id.
     *
     * @return bool
     */
    public function destroy($id)
    {
        try {
            if (count($this->getDepartmentCountBelongstoUsers($id)) > 0) {
                return back()->with('assigned_to_user',  trans('message.assigned_not_deleted'));
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
