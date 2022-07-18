<?php

namespace App\Http\Controllers\FrontEnd;

use Log;
use Throwable;
use App\Models\Service;
use Illuminate\View\View;
use App\Models\KnowledgeBase;
use App\Models\ArticleComment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;

class KnowledgeBaseController extends Controller
{


    /**
     * Show the knowledgeBase.
     *
     * @return \Illuminate\View\View;
     */
    public function knowledgeBase(): View
    {
        try {
            $knowledges = Service::with('knowledges')->get();
            return view('frontend.knowledgebase.knowledge-base', compact('knowledges'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.no_record'));
        }
    }

    public function knowledgeDetail($id): View
    {

        try {
            $article = KnowledgeBase::with('service')->find($id);
            $comments = ArticleComment::where('knowledge_id', $id)
                ->with('user')
                ->get();
            $commnetCount = ArticleComment::where('knowledge_id', $id)->count();

            return view('frontend.knowledgebase.knowledge-details', compact('article', 'comments', 'commnetCount'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.no_record'));
        }
    }

    /**
     * post KnowledgeBase comment.
     *
     * @return bool
     */
    public function storeComment(StoreCommentRequest $request)
    {
        try {
            ArticleComment::create($request->all());
            return back()->with('comment',  trans('message.comment_saved'));
        } catch (Throwable $e) {
            Log::debug($e->getMessage());
            return back()->with('error', trans('message.server_error'));
        }
    }
}
