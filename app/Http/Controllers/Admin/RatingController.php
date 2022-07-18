<?php

namespace App\Http\Controllers\Admin;

use Log;
use Throwable;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Repositories\RatingRepositoryInterface;

class RatingController extends Controller
{
    /**
     * Create constructor.
     *
     * @return void
     */
    private $repository;

    public function __construct(RatingRepositoryInterface $repository)
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
            $ratings = $this->repository->all();
            return view('admin.rating.index', compact('ratings'));
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
