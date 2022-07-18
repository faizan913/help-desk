<?php


namespace App\Repositories\Eloquent;

use App\Models\Comment;
use App\Models\ArticleComment;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\ArticleCommentRepositoryInterface;

class ArticleCommentRepository extends BaseRepository implements ArticleCommentRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Comment $model
     */
    public function __construct(ArticleComment $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all($relations = []): Collection
    {
        return $this->model->with($relations)->get();
    }


    /**
     * Delete model by model id
     * @param  $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool
    {
        return $this->model->find($modelId)->delete();
    }
}
