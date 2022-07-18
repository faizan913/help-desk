<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface DepartmentRepositoryInterface
{

    /**
     * @param $id
     * @return Model
     */
    public function all($relations = []): Collection;

    /**
     * Update existing model
     * @param array $attributes
     * @return bool
     */
    public function updateDepartment($modelId, array $attributes): bool;

    /**
     * Delete model 
     * @param $modelId
     * @return bool.
     */
    public function deleteById(int $modelId): bool;
}
