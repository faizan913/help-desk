<?php

namespace App\Http\Controllers\Admin;

use Log;
use Throwable;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Repositories\CommentRepositoryInterface;

class CommentController extends Controller
{
    /**
     * Create constructor.
     *
     * @return void
     */
    private $repository;

    public function __construct(CommentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the application comment.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        try {
            if (auth()->user()->hasRole('Admin')) {
                $comments = $this->repository->all();
            } else {
                $comments = $this->repository->loggedInUserRecords(['status', 'priority', 'service', 'assigned_to_user'], auth()->id());
            }
            return view('admin.comments.index', compact('comments'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.no_record'));
        }
    }

    /**
     * Delete Comment by model id.
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
