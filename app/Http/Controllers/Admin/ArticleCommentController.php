<?php

namespace App\Http\Controllers\Admin;

use Log;
use Throwable;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Repositories\ArticleCommentRepositoryInterface;

class ArticleCommentController extends Controller
{
    /**
     * Create constructor.
     *
     * @return void
     */
    private $repository;

    public function __construct(ArticleCommentRepositoryInterface $repository)
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
            $comments = $this->repository->all();
            //dd($comments);
            return view('admin.articlecomments.index', compact('comments'));
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
