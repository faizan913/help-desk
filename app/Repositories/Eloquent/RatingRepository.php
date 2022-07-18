<?php


namespace App\Repositories\Eloquent;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\RatingRepositoryInterface;

class RatingRepository extends BaseRepository implements RatingRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Rating $model
     */
    public function __construct(Rating $model)
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
     * Delete model by model id
     * @param  $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool
    {
        return $this->model->find($modelId)->delete();
    }
}
