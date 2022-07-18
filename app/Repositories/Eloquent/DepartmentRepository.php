<?php


namespace App\Repositories\Eloquent;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\DepartmentRepositoryInterface;

class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface
{

    /**
     * Department Repository constructor.
     *
     * @param Department $model
     */
    public function __construct(Department $model)
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
     * update Model by id
     * @param array $attributes
     *
     * @return bool
     */
    public function updateDepartment($modelId, array $attributes): bool
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
