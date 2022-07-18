<?php


namespace App\Repositories\Eloquent;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\ServiceRepositoryInterface;

class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Service $model
     */
    public function __construct(Service $model)
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
    public function storeService(array $attributes): Model
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
    public function updateService($modelId, array $attributes): bool
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
