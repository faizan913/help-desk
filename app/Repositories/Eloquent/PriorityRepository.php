<?php


namespace App\Repositories\Eloquent;

use App\Models\Priority;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\PriorityRepositoryInterface;

class PriorityRepository extends BaseRepository implements PriorityRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Priority $model
     */
    public function __construct(Priority $model)
    {
        parent::__construct($model);
    }

    /**
     * Find all model
     * @return Collection
     */
    public function all($relations = []): Collection
    {
        return $this->model->with($relations)->get();
    }


    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function storeRepository(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @return Model
     */
    public function findPriorityByID($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * update Model by id
     * @param array $attributes
     *
     * @return bool
     */
    public function updateRepository($modelId, array $attributes): bool
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
