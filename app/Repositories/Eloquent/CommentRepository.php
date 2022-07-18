<?php


namespace App\Repositories\Eloquent;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CommentRepositoryInterface;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Comment $model
     */
    public function __construct(Comment $model)
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
     * @return Collection
     */
    public function loggedInUserRecords($relations = [], $loggedInId): Collection
    {
        return $this->model->with($relations)
            ->where('created_by', $loggedInId)
            ->orWhere('assigned_to_user_id', auth()->id())
            ->get();
    }

    /**
     * update Model by id
     * @param array $attributes
     *
     * @return bool
     */
    public function commentUpdate($modelId, array $attributes): bool
    {
        return  $this->model->where('id', $modelId)->update($attributes);
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
