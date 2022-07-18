<?php

namespace App\Http\Controllers\Admin;

use Log;
use Throwable;
use Illuminate\View\View;
use App\Models\KnowledgeBase;
use App\Http\Traits\QueryTrait;
use App\Http\Controllers\Controller;
use App\Services\Admin\KnowledgeService;
use App\Http\Requests\KnowledgeBaseRequest;
use App\Repositories\KnowledgeRepositoryInterface;

class KnowledgeBaseController extends Controller
{
    use QueryTrait;

    /**
     * Create constructor.
     *
     * @return void
     */
    private $repository;
    private $service;

    public function __construct(KnowledgeRepositoryInterface $repository, KnowledgeService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Show users.
     *
     * @return Illuminate\View\View
     */
    public function index(): View
    {
        try {
            $data = $this->repository->all(['service']);
            return view('admin.knowledgebase.index', compact('data'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }
    /**
     * Show resource.
     *
     * @return Illuminate\View\View
     */
    public function show($id): View
    {
        try {
            $article = $this->repository->findArticle(['service'], $id);
            return view('admin.knowledgebase.show', compact('article'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }

    /**
     * Create resource.
     *
     * @return Illuminate\View\View
     */
    public function create(): View
    {
        try {
            $data['services'] = $this->getService();
            return view('admin.knowledgebase.create', compact('data'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }
    /**
     * Store record
     *
     * @param  KnowledgeBaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KnowledgeBaseRequest $request)
    {
        try {
            $this->service->createOrUpdate($request);
            return redirect()->route('knowledges.index')->with('success',  trans('message.record_saved'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  KnowledgeBase  $knowledge
     * @return \Illuminate\Http\Response
     */
    public function edit(KnowledgeBase $knowledge)
    {
        try {
            $data['services'] = $this->getService();
            $data['knowledge'] = $this->service->findByID(['service'], $knowledge->id);
            return view('admin.knowledgebase.edit', compact('data'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }

    /**
     * Update existing records
     *
     * @param  KnowledgeBaseRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(KnowledgeBaseRequest $request, KnowledgeBase $knowledge)
    {
        try {
            $this->service->createOrUpdate($request);
            return redirect()->route('knowledges.index')->with('success',  trans('message.record_updated'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }

    /**
     * Delete records.
     *
     * @return bool
     */
    public function destroy($id)
    {
        try {
            $this->repository->deleteById($id);
            return back()->with('delete',  trans('message.record_deleted'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }
}
