<?php

namespace App\Services\Admin;

use App\Models\Comment;
use App\Repositories\Eloquent\CommentRepository;

class CommentService
{
    /**
     * The Configuration repository instance.
     *
     * @var CommentRepository
     */

    private $repository;

    public function __construct(CommentRepository $repository)
    {
        $this->repository = $repository;
    }

    public  function show($collections = [], $id)
    {
        return $this->repository->find($collections, $id);
    }

    public function saveComment($request)
    {

        $comments = [
            'author_name' => $request->author_name,
            'author_email' => $request->author_email,
            'comment' => $request->comment,
            'user_id' => auth()->user()->id,
            'ticket_id' => $request->ticket_id,
        ];

        if (!empty($request->comment_id)) {
            $ticket = Comment::find($request->ticket_id);
            $this->repository->commentUpdate($request->ticket_id, $comments);
            return $ticket;
        } else {
            $ticket = $this->repository->create($comments);
            return $ticket;
        }
    }
}
