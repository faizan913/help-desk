<?php


namespace App\Repositories\Eloquent;

use App\Models\KnowledgeBase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\KnowledgeRepositoryInterface;

class KnowledgeRepository extends BaseRepository  implements KnowledgeRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param KnowledgeBase $model
     */
    public function __construct(KnowledgeBase $model)
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
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * update Model by id
     * @param array $attributes
     *
     * @return bool
     */
    public function update($modelId, array $attributes): bool
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

    /**
     * @param $id
     * @return Model
     */
    public function findArticle($relations = [], $id): ?Model
    {
        return $this->model->with($relations)->find($id);
    }
}
