<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Eloquent\KnowledgeRepository;

class KnowledgeService
{
    /**
     * The Configuration repository instance.
     *
     * @var TicketRepository
     */

    private $repository;

    public function __construct(KnowledgeRepository $repository)
    {
        $this->repository = $repository;
    }

    public  function findByID($collections = [], $id)
    {
        return $this->repository->find($collections, $id);
    }

    public function createOrUpdate($request)
    {
        $knowledges = [
            'service_id' => $request->service,
            'question' => $request->question,
            'answer' => $request->answer,
        ];
        if (!empty($request->knowledge_id)) {
            $knowledge = User::find($request->knowledge_id);
            $this->repository->update($request->knowledge_id, $knowledges);

            return $knowledge;
        } else {
            $knowledge = $this->repository->create($knowledges);
            return $knowledge;
        }
    }
}
